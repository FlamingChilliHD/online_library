<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\User;
use Illuminate\Http\Request;

class LibrarianController extends Controller
{
    public function dashboard() {
        $visitors = User::where('is_librarian', '=', false)->get();
        $loans = Loan::get();

        return view('librarian\dashboard', compact('visitors', 'loans'));
    }
}
