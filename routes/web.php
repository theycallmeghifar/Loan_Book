<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookCategoriesController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoansController;
use App\Http\Controllers\UsersController;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


//Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::redirect('/', '/dashboard');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/users', [UsersController::class, 'index'])->name('users');
    Route::get('/getUsersById', [UsersController::class, 'getUsersById'])->name('getUsersById');
    Route::post('/addUsers', [UsersController::class, 'create'])->name('addUsers');
    Route::post('/updateUsers', [UsersController::class, 'update'])->name('updateUsers');
    Route::delete('/deleteUsers/{id}', [UsersController::class, 'delete'])->name('deleteUsers');
    
    Route::get('/categories', [CategoriesController::class, 'index'])->name('categories');
    Route::get('/getAllCategories', [CategoriesController::class, 'getAllCategories'])->name('getAllCategories');
    Route::get('/getCategoriesById', [CategoriesController::class, 'getCategoriesById'])->name('getCategoriesById');
    Route::post('/addCategories', [CategoriesController::class, 'create'])->name('addCategories');
    Route::post('/updateCategories', [CategoriesController::class, 'update'])->name('updateCategories');
    Route::delete('/deleteCategories/{id}', [CategoriesController::class, 'delete'])->name('deleteCategories');
    
    Route::get('/books', [BooksController::class, 'index'])->name('books');
    Route::get('/getAllBooks', [BooksController::class, 'getAllBooks'])->name('getAllBooks');
    Route::get('/getBooksById', [BooksController::class, 'getBooksById'])->name('getBooksById');
    Route::post('/addBooks', [BooksController::class, 'create'])->name('addBooks');
    Route::post('/updateBooks', [BooksController::class, 'update'])->name('updateBooks');
    Route::delete('/deleteBooks/{id}', [BooksController::class, 'delete'])->name('deleteBooks');
    
    Route::get('/bookCategories', [BookCategoriesController::class, 'index'])->name('bookCategories');
    Route::get('/getBookCategoriesById', [BookCategoriesController::class, 'getBookCategoriesById'])->name('getBookCategoriesById');
    Route::post('/addBookCategories', [BookCategoriesController::class, 'create'])->name('addBookCategories');
    Route::post('/updateBookCategories', [BookCategoriesController::class, 'update'])->name('updateBookCategories');
    Route::delete('/deleteBookCategories/{id}', [BookCategoriesController::class, 'delete'])->name('deleteBookCategories');
    
    Route::get('/loans', [LoansController::class, 'index'])->name('loans');
    Route::get('/getLoansById', [LoansController::class, 'getLoansById'])->name('getLoansById');
    Route::post('/addLoans', [LoansController::class, 'create'])->name('addLoans');
    Route::post('/updateLoans', [LoansController::class, 'update'])->name('updateLoans');
    Route::delete('/deleteLoans/{id}', [LoansController::class, 'delete'])->name('deleteLoans');
});