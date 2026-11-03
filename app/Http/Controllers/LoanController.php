<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Models\Loan;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{
    public function index() {
        $loans = Loan::with('book')->where('user_id', '=', Auth::id())
        ->whereNull('returned_at')
        ->latest()->paginate(5);

        return view('loans/index', compact('loans'));
    }

    public function create(Book $book) {
        return view('loans/form', compact('book'));
    }

    public function store(Book $book, Request $request) {
        $limit = today()->addDays(30);
        $input_date = Carbon::parse($request->due_date);

        if ($input_date->gt($limit)) {
            $invalid_date = 'Book cannot be loaned for more than 30 days.';
            return redirect()->route('loan_create', $book)
            ->with('invalid_date', $invalid_date);
        }

        if ($book->stock <= 0) {
            $no_stock = 'Book is out of stock.';
            return redirect()->route('loan_create', $book)
            ->with('no_stock', $no_stock);
        }

        $book->decrement('stock');
        $loan = Loan::create([
            'user_id' => Auth::id(),
            'book_id' => $book->id,
            'borrowed_at' => today(),
            'due_date' => $input_date,
        ]);

        $loaned = 'Book successfully loaned.';
        return redirect()->route('loan_show', $loan)
        ->with('success', $loaned);
    }

    public function show(Loan $loan) {
        return view('loans/show', compact('loan'));
    }

    public function return(Loan $loan) {
        Artisan::call('loans:update-fines');

        if ($loan->fine_amount > 0.00 && $loan->fine_paid = false) {
            $fine_pay = 'Please pay your fine before returning the book.';

            return redirect()->route('fine_create')->with([
                'loan' => $loan,
                'fine_pay' => $fine_pay,
            ]);
        }

        return view('loans/return', compact('loan'));
    }

    public function update(Loan $loan) {
        $return_date = today();
        $loan->returned_at = $return_date;

        $loan->book->increment('stock');
        $loan->update();

        $returned = 'Book returned successfully.';
        return redirect()->route('books_index')
        ->with('returned', $returned);
    }

    public function returned() {
        $loans = Loan::with('book')
        ->where('user_id', '=', Auth::id())
        ->whereNotNull('returned_at')
        ->latest()->paginate(5);

        return view('loans/returned', compact('loans'));
    }
}
