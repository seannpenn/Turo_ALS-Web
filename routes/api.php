<?php
use App\Http\Controllers\Api\PostController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\CourseContentController;
use App\Http\Controllers\Api\TopicController;
use App\Http\Controllers\Api\AuthController;
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

Route::apiResource('posts', PostController::class);

Route::post('/register', [AuthController::class, 'teacherRegister']);
Route::post('/login', [AuthController::class, 'StudentLogin']); //ok
Route::get('/course', [CourseController::class, 'show']); //ok
Route::get('/module', [CourseContentController::class, 'show']); //ok
Route::get('/topic', [TopicController::class, 'show']); //ok