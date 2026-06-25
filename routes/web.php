<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\BooksItemController;
use App\Http\Controllers\ReturnController;
use App\Http\Controllers\LoanQuickController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return inertia('WelcomeLibrary');
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 📚 本の管理（ログイン必須にしたいならここに入れる）
    Route::resource('books', BookController::class);

    // 📕 冊子（現物）の管理・貸出返却
    Route::get('/books-items', [BooksItemController::class, 'index'])
        ->name('books-items.index');
    
    // 📚 本IDを渡して📕 冊子一覧を見る
    Route::get('/books/{book}/items', [BooksItemController::class, 'indexByBook'])
        ->name('books.items.index');

    Route::get('/books/{book}/items/create', [BooksItemController::class, 'create'])
        ->name('books.items.create');

    Route::post('/books/{book}/items', [BooksItemController::class, 'store'])
        ->name('books.items.store');

    //貸出ルート
    Route::post('/books-items/{item}/borrow', [BorrowController::class, 'borrow'])
        ->name('books-items.borrow');
    //返却ルート
    Route::post('/books-items/{item}/return', [ReturnController::class, 'store'])
        ->name('books-items.return');
    
    // 貸出・返却画面（表示用）
    Route::get('/loans/quick', [LoanQuickController::class, 'index'])
        ->middleware(['auth'])
        ->name('loans.quick');

    // 貸出・返却処理（処理用）
    Route::post('/loans/quick', [LoanQuickController::class, 'store'])
    ->middleware(['auth'])
    ->name('loans.quick.store');
});

require __DIR__.'/auth.php';
