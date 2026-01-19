<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function index() {
        $books = Book::with('category')
        ->latest()->paginate(5);

        return view('books/books_index', compact('books'));
    }
}
