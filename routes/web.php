<?php

use App\Http\Controllers\BooksController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashbord.index');
});


Route::get('/all-books',[BooksController::class,'index'])->name("books");
Route::get('/books/create',[BooksController::class,'create'])->name("books.create");
Route::post('/create/store',[BooksController::class,'store'])->name("books.store");
Route::get('/books/edit/{id}',[BooksController::class,'Edit'])->name("books.edit");
Route::post('/books/update/{id}',[BooksController::class,'update'])->name("books.update");
Route::get('/books/delete/{id}',[BooksController::class,'delete'])->name("books.delete");

Route::post('/books/search/title',[BooksController::class,'search_title'])->name("books.search.title");
Route::post('/books/search/price',[BooksController::class,'search_price'])->name(name: "books.search.price");





Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
