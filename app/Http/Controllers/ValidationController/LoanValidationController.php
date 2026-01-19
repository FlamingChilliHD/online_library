<?php

namespace App\Http\Controllers\ValidationController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Loan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoanValidationController extends Controller
{
    /**
     * Validate loan creation request
     */
    public function validateLoanCreation(Request $request, Book $book): array
    {
        // Only get the fields we expect
        $input = $request->only(['book_id', 'user_id']);

        // Get authenticated user if not provided
        $user_id = $input['user_id'] ?? Auth::id();

        // Validation rules
        $rules = [
            'book_id' => 'required|exists:books,id',
            'user_id' => 'required|exists:users,id',
        ];

        // Custom validation messages
        $messages = [
            'book_id.required' => 'Book is required',
            'book_id.exists' => 'Book does not exist',
            'user_id.required' => 'User is required',
            'user_id.exists' => 'User does not exist',
        ];

        // Create validator with only the expected input
        $validator = Validator::make($input, $rules, $messages);

        if ($validator->fails()) {
            return ['success' => false, 'errors' => $validator->errors()];
        }

        // Business logic validation
        if ($book->stock <= 0) {
            return ['success' => false, 'errors' => ['book_stock' => 'This book is currently out of stock']];
        }

        if ($this->userHasActiveLoan($user_id, $book->id)) {
            return ['success' => false, 'errors' => ['active_loan' => 'You already have an active loan for this book']];
        }

        // If all validations pass
        return [
            'success' => true,
            'data' => [
                'user_id' => $user_id,
                'book_id' => $book->id,
                'reduced_stock' => $book->stock - 1
            ]
        ];
    }

    /**
     * Check if user has active loan for a book
     */
    public function userHasActiveLoan(int $user_id, int $book_id): bool
    {
        return Loan::where('user_id', $user_id)
                 ->where('book_id', $book_id)
                 ->whereNull('returned_at')
                 ->exists();
    }

    /**
     * Validate loan return request
     */
    public function validateLoanReturn(Request $request, Book $book, Loan $loan): array
    {
        // No input needed for this validation as we're validating existing models

        // Business logic validation
        if ($loan->returned_at !== null) {
            return ['success' => false, 'errors' => ['already_returned' => 'This book has already been returned']];
        }

        if ($loan->book_id !== $book->id) {
            return ['success' => false, 'errors' => ['mismatch' => 'The loan does not match the book']];
        }

        // If all validations pass
        return [
            'success' => true,
            'data' => [
                'book_id' => $book->id,
                'increased_stock' => $book->stock + 1
            ]
        ];
    }
}
