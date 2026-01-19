<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LoanController;

Route::get('/', function () {
    if (Auth::guest()) {
        return redirect('/login');
    }

    return redirect('/home');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function() {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/books/books_index', [BookController::class, 'index'])->name('books_index');

    Route::prefix('loans')->group(function() {
        Route::controller(LoanController::class)->group(function () {
            Route::get('loans_index', 'index')->name('loans_index');
            Route::get('loan_create/{book}', 'create')->name('loan_create');
            Route::post('loan_store/{book}', 'store')->name('loan_store');
            Route::get('loan_show/{loan}', 'show')->name('loan_show');
            Route::put('loan_update/{loan}', 'update')->name('loan_update');
            Route::get('loans_returned', 'returned')->name('loans_returned');
        });
    });
});
