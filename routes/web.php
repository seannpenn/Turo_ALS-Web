<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CourseController;
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

// Route::resource('students', StudentController::class);
// Route::get('students', [StudentController::class, 'index']);



//for login and register routes
Route::view('/login', 'login.login')->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('user.login');
Route::get('/logout', [LoginController::class, 'logout'])->name('user.logout');

Route::view('/register', 'login.registration')->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('user.register');

Route::middleware(['auth'])->group(function(){
    // For student routes

    // For user routes
    Route::get('/home', [UserController::class, 'showCurrentUser'])->name('home');
    Route::get('/users/all', [UserController::class, 'showAllUsers'])->name('users.all');
    Route::get('user/{id}/delete',[UserController::class,'delete'])->name('user.delete');
    // Route::view('/home', 'showallstudents')->name('home');

    // For create courses
    Route::post('/course/create', [CourseController::class, 'create'])->name('course.create');
});

