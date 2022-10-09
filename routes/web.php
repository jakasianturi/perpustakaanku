<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Home
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// About
Route::get('/about', [App\Http\Controllers\HomeController::class, 'about'])->name('about');
// Search Book
Route::get('/search', [App\Http\Controllers\BookController::class, 'searchBook'])->name('searchBook');
// Book
Route::get('/books', [App\Http\Controllers\BookController::class, 'index'])->name('books');
Route::get('/books/getDataCategory', [App\Http\Controllers\BookController::class, 'getDataCategory'])->name('getDataCategory');
Route::get('/books/getDataAuthor', [App\Http\Controllers\BookController::class, 'getDataAuthor'])->name('getDataAuthor');
Route::get('/books/getDataPublication', [App\Http\Controllers\BookController::class, 'getDataPublication'])->name('getDataPublication');
Route::get('/books/getDataPublisher', [App\Http\Controllers\BookController::class, 'getDataPublisher'])->name('getDataPublisher');
Route::get('/books/{book:slug}', [App\Http\Controllers\BookController::class, 'detailBook'])->name('detailBook');
// Category
Route::get('/categories/{category:slug}', [App\Http\Controllers\CategoryController::class, 'detailCategory'])->name('detailCategory');
// News
Route::get('/news/{news:slug}', [App\Http\Controllers\NewsController::class, 'detailNews'])->name('detailNews');



Auth::routes(['verify' => true]);
// Laravel Filemanager
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['role:admin', 'auth', 'verified']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
Route::group(['prefix' => 'dashboard', 'middleware' => ['role:admin', 'auth', 'verified']], function () {
    Route::name('dashboard.')->group(function () {
        // Dashboard
        Route::get('/', [App\Http\Controllers\Dashboard\DashboardController::class, 'index'])->name('dashboard');
        // Category
        Route::resource('/categories', App\Http\Controllers\Dashboard\CategoryController::class)
        ->except(['show']);
        // Bookshelf
        Route::resource('/bookshelves', App\Http\Controllers\Dashboard\BookshelfController::class)
        ->except(['show']);
        // Book
        Route::get('/books/getDataCategory', [App\Http\Controllers\Dashboard\BookController::class, 'getDataCategory'])->name('books.getDataCategory');
        Route::get('/books/getDataBookshelf', [App\Http\Controllers\Dashboard\BookController::class, 'getDataBookshelf'])->name('books.getDataBookshelf');
        Route::resource('/books', App\Http\Controllers\Dashboard\BookController::class)
        ->except(['show']);
        // Borrow
        Route::get('/borrows/getDataMember', [App\Http\Controllers\Dashboard\BorrowController::class, 'getDataMember'])->name('borrows.getDataMember');
        Route::get('/borrows/getDataBook', [App\Http\Controllers\Dashboard\BorrowController::class, 'getDataBook'])->name('borrows.getDataBook');
        Route::resource('/borrows', App\Http\Controllers\Dashboard\BorrowController::class)
        ->except(['show']);
        // Returned
        Route::get('/returneds/nonactive', [App\Http\Controllers\Dashboard\ReturnedController::class, 'nonactive'])->name('returneds.nonactive');
        Route::get('/returneds/getDataMember', [App\Http\Controllers\Dashboard\ReturnedController::class, 'getDataMember'])->name('returneds.getDataMember');
        Route::get('/returneds/getDataBook', [App\Http\Controllers\Dashboard\ReturnedController::class, 'getDataBook'])->name('returneds.getDataBook');
        Route::resource('/returneds', App\Http\Controllers\Dashboard\ReturnedController::class)
        ->parameters([
            'returneds' => 'borrow'
        ])->except(['create', 'show']);
        // User
        Route::resource('/users', App\Http\Controllers\Dashboard\UserController::class)
        ->except(['show']);
        // News
        Route::get('/news/getDataAdmin', [App\Http\Controllers\Dashboard\NewsController::class, 'getDataAdmin'])->name('news.loadDataAdmin');
        Route::resource('/news', App\Http\Controllers\Dashboard\NewsController::class)
        ->except(['show']);
        // Site Settings
        Route::resource('/settings', App\Http\Controllers\Dashboard\SettingController::class)
        ->except(['create', 'store', 'show', 'destroy']);
        // Banner
        Route::resource('/banners', App\Http\Controllers\Dashboard\BannerController::class)
        ->except(['show']);
        // Profile
        Route::post('/profiles', [App\Http\Controllers\Dashboard\ProfileController::class, 'updateAvatar'])->name('profiles.updateAvatar');
        Route::resource('/profiles', App\Http\Controllers\Dashboard\ProfileController::class)
        ->parameters([
            'profiles' => 'user'
        ])->except(['create', 'store', 'show', 'destroy']);
        // Log Files
        Route::get('/log-files', [App\Http\Controllers\Dashboard\LogFilesController::class, 'index'])->name('log-files.index');
        Route::get('/log-files/{filename}', [App\Http\Controllers\Dashboard\LogFilesController::class, 'show'])->name('log-files.show');
        Route::get('/log-files/{filename}/download', [App\Http\Controllers\Dashboard\LogFilesController::class, 'download'])->name('log-files.download');
    });
});

Route::group(['prefix' => 'member', 'middleware' => ['role:member', 'auth', 'verified']], function () {
    Route::name('member.')->group(function () {
        // Dashboard Member
        Route::get('/', [App\Http\Controllers\Member\DashboardController::class, 'index'])->name('member');
        // Borrow
        Route::get('/borrows/getDataMember', [App\Http\Controllers\Member\BorrowController::class, 'getDataMember'])->name('borrows.getDataMember');
        Route::get('/borrows/getDataBook', [App\Http\Controllers\Member\BorrowController::class, 'getDataBook'])->name('borrows.getDataBook');
        Route::resource('/borrows', App\Http\Controllers\Member\BorrowController::class)->except(['show']);
        // Returned
        Route::get('/returneds/nonactive', [App\Http\Controllers\Member\ReturnedController::class, 'nonactive'])->name('returneds.nonactive');
        Route::get('/returneds', [App\Http\Controllers\Member\ReturnedController::class, 'index'])->name('returneds.index');
        // Profile
        Route::post('/profiles', [App\Http\Controllers\Member\ProfileController::class, 'updateAvatar'])->name('profiles.updateAvatar');
        Route::resource('/profiles', App\Http\Controllers\Member\ProfileController::class)
        ->parameters([
            'profiles' => 'user'
        ])->except(['create', 'store', 'show', 'destroy']);
    });
});