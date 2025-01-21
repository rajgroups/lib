<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\BookController;
use App\Http\Controllers\admin\AuthorController;
use App\Models\author;
use App\Models\book;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/* Book Route Details
*
*
*
*/
// GET|HEAD        book ............................... book.index › admin\BookController@index  
// POST            book ............................... book.store › admin\BookController@store  
// GET|HEAD        book/create ...................... book.create › admin\BookController@create  
// GET|HEAD        book/{book} .......................... book.show › admin\BookController@show  
// PUT|PATCH       book/{book} ...................... book.update › admin\BookController@update  
// DELETE          book/{book} .................... book.destroy › admin\BookController@destroy  
// GET|HEAD        book/{book}/edit ..................... book.edit › admin\BookController@edit  

Route::resource('book', BookController::class);
Route::resource('author', AuthorController::class);

 // Admin Home Route
 Route::get('/dasboard',function(){

    $totalBookcount = book::count();
    $totalauthor = author::count();
    return view('admin.home.index',compact('totalBookcount','totalauthor'));
 })->name('admin.dashboard');