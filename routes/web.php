<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseContentController;
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


//for login and register routes
Route::view('/login', 'login.login')->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('user.login');
Route::get('/logout', [LoginController::class, 'logout'])->name('user.logout');

Route::view('/register', 'login.registration')->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('user.register');

Route::middleware(['auth'])->group(function(){
    // For student routes

    // For user routes
    Route::view('/home', 'home.home')->name('home');
    Route::get('/users/all', [UserController::class, 'showAllUsers'])->name('users.all');
    Route::get('user/{id}/delete',[UserController::class,'delete'])->name('user.delete');

    // For create courses
    Route::post('/course/create', [CourseController::class, 'create'])->name('course.create');
    Route::get('/course/all', [CourseController::class, 'showOwnedCourses'])->name('course.all');
    Route::get('course/{id}/info', [CourseController::class,'showCourse'])->name('course.showInfo');
    Route::get('course/{id}/delete', [CourseController::class,'delete'])->name('course.delete');

    // for create course content
    Route::post('/course/content/create', [CourseContentController::class, 'create'])->name('content.create');

});


