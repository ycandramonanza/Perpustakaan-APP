<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route Manage Admin
Route::get('/manage-admin', [App\Http\Controllers\ManageAdminController::class, 'index'])->name('manage-admin.index');
Route::get('/manage-admin/create/{id?}', [App\Http\Controllers\ManageAdminController::class, 'create'])->name('manage-admin.create');
Route::post('/manage-admin/store', [App\Http\Controllers\ManageAdminController::class, 'store'])->name('manage-admin.store');
Route::post('/manage-admin/update/{id}', [App\Http\Controllers\ManageAdminController::class, 'update'])->name('manage-admin.update');
Route::delete('/manage-admin/delete/{id}', [App\Http\Controllers\ManageAdminController::class, 'destroy'])->name('manage-admin.delete');
Route::get('/manage-admin/status-enable/{id}', [App\Http\Controllers\ManageAdminController::class, 'statusEnable'])->name('manage-admin.status-enable');
Route::get('/manage-admin/status-disable/{id}', [App\Http\Controllers\ManageAdminController::class, 'statusDisable'])->name('manage-admin.status-disable');


// Route Manage Users
Route::get('/manage-users', [App\Http\Controllers\ManageUsersController::class, 'index'])->name('manage-users.index');
Route::get('/manage-users/create/{id?}', [App\Http\Controllers\ManageUsersController::class, 'create'])->name('manage-users.create');
Route::post('/manage-users/store', [App\Http\Controllers\ManageUsersController::class, 'store'])->name('manage-users.store');
Route::post('/manage-users/update/{id}', [App\Http\Controllers\ManageUsersController::class, 'update'])->name('manage-users.update');
Route::delete('/manage-users/delete/{id}', [App\Http\Controllers\ManageUsersController::class, 'destroy'])->name('manage-users.delete');
Route::get('/manage-users/status-enable/{id}', [App\Http\Controllers\ManageUsersController::class, 'statusEnable'])->name('manage-users.status-enable');
Route::get('/manage-users/status-disable/{id}', [App\Http\Controllers\ManageUsersController::class, 'statusDisable'])->name('manage-users.status-disable');

// Route Manage Books
Route::get('/books', [App\Http\Controllers\ManageBooksController::class, 'index'])->name('books.index');
Route::get('/books/create/{id?}', [App\Http\Controllers\ManageBooksController::class, 'create'])->name('books.create');
Route::post('/books/store', [App\Http\Controllers\ManageBooksController::class, 'store'])->name('books.store');
Route::post('/books/update/{id}', [App\Http\Controllers\ManageBooksController::class, 'update'])->name('books.update');
Route::get('/books/show/{id}', [App\Http\Controllers\ManageBooksController::class, 'show'])->name('books.show');
Route::get('/books/borrow/{id}', [App\Http\Controllers\ManageBooksController::class, 'borrow'])->name('books.borrow');
Route::delete('/books/delete/{id}', [App\Http\Controllers\ManageBooksController::class, 'destroy'])->name('books.delete');



