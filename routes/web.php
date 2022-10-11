<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\FolderController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Models\File;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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
    return view('login.index');
});

Route::get('/mainpage/files/{folder:slug}', [FileController::class, 'index'])->middleware('auth');
Route::get('/mainpage/files/{folder:slug}/create', [FileController::class, 'create'])->middleware('auth');

Route::get('/mainpage/folders/checkSlug',[FolderController::class, 'checkSlug']);

Route::get('/dashboard',[DashboardController::class,'index'])->middleware('auth');

Route::get('/login',[LoginController::class,'index'])->name('login')->middleware('guest');
Route::post('/login',[LoginController::class,'authenticate']);
Route::post('/logout',[LoginController::class,'logout']);

Route::get('/register',[RegisterController::class,'index'])->middleware('guest');
Route::post('/register',[RegisterController::class,'store']);

Route::get('/profile',[ProfileController::class,'edit'])->middleware('auth');
Route::put('/profile/{user:id}',[ProfileController::class,'update'])->middleware('auth');

Route::resource('/mainpage/folders', FolderController::class)->middleware('auth');
Route::resource('/mainpage/files',FileController::class)->middleware('auth');
