<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loan;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

class FineController extends Controller
{
    public function index() {
        $fined_loans = Loan::where('user_id', '=', Auth::id())
        ->where('fine_amount', '>', 0.00);

        return view('fines/index', compact('fined_loans'));
    }

    public function create(Loan $loan) {
        return view('fine/create', compact('loan'));
    }

    public function store(Loan $loan) {
        $loan->fine_paid = true;
        $loan->update();

        $fine_paid = 'You have paid your fine. You may now return the book.';

        return redirect()->route('loan_return', $loan)->with(compact('fine_paid'));
    }
}
