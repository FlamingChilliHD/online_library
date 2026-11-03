<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\FineController;
use App\Http\Controllers\LoanController;

Route::get('/', function () {
    if (Auth::guest()) {
        return redirect('/login');
    }

    return redirect('/home');
});

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('home', [HomeController::class, 'index'])->name('home');

    Route::get('books_index', [BookController::class, 'index'])->name('books_index');

    Route::controller(LoanController::class)->group(function() {
        Route::get('loans_index', 'index')->name('loans_index');
        Route::get('loan_create/{book}', 'create')->name('loan_create');
        Route::post('loan_store/{book}', 'store')->name('loan_store');
        Route::get('loan_show/{loan}', 'show')->name('loan_show');
        Route::get('loan_return/{loan}', 'return')->name('loan_return');
        Route::put('loan_update/{loan}', 'update')->name('loan_update');
        Route::get('loans_returned', 'returned')->name('loans_returned');
    });

    Route::controller(FineController::class)->group(function () {
        Route::get('fines_index', 'index')->name('fines_index');
        Route::get('fine_create/{loan}', 'create')->name('fine_create');
        Route::post('fine_store/{loan}', 'store')->name('fine_store');
    });
});
