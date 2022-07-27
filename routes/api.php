<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseContentController;
use App\Http\Controllers\TopicController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::view('/login', 'login.login')->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('user.login');
Route::get('/logout', [LoginController::class, 'logout'])->name('user.logout');

Route::view('/register', 'login.registration')->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('user.register');



Route::middleware(['auth'])->group(function(){
    // For student routes
    Route::get('/users/all', [UserController::class, 'showAllUsers'])->name('users.all');
    // For user routes
    Route::view('/home', 'home.home')->name('home');
    
    Route::get('user/{id}/delete',[UserController::class,'delete'])->name('user.delete');

    // For create courses
    Route::post('/course/create', [CourseController::class, 'create'])->name('course.create');
    Route::get('/course/all', [CourseController::class, 'showOwnedCourses'])->name('course.all');
    Route::get('course/{id}', [CourseController::class,'showCourse'])->name('course.showInfo');
    Route::get('course/{id}/delete', [CourseController::class,'delete'])->name('course.delete');

    // for create course content
    Route::post('/course/content/create', [CourseContentController::class, 'create'])->name('content.create');
    Route::get('/course/content/{id}/delete', [CourseContentController::class, 'delete'])->name('content.delete');

    // for create content topic

    Route::post('/course/content/topic/create', [TopicController::class, 'create'])->name('topic.create');


    // Route::post('/course/content/create', [CourseContentController::class, 'create'])->name('content.delete');
});


