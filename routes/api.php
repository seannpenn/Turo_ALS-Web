<?php
use App\Http\Controllers\Api\PostController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\QuizController;
use App\Http\Controllers\Api\CourseContentController;
use App\Http\Controllers\Api\TopicController;
use App\Http\Controllers\Api\TopicContentController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('posts', PostController::class);

Route::middleware('auth:sanctum')->group(function(){
    
});
Route::post('/login', [AuthController::class, 'StudentLogin']); //ok
Route::post('/logout', [AuthController::class, 'logout']);
Route::post('/register', [AuthController::class, 'teacherRegister']);
Route::get('/{id}/course', [CourseController::class, 'show']); //ok

Route::get('/course/{id}/module', [CourseContentController::class, 'show']); //ok
Route::get('/module/{id}/topic', [TopicController::class, 'show']); 
Route::get('/topic/{id}/topicContent', [TopicContentController::class, 'getTopicContent']); 
Route::get('/course/{id}/quiz', [QuizController::class, 'show']);
Route::get('/quiz/{id}/questions', [QuizController::class, 'getQuestion']);
Route::get('/quiz/{id}/options', [QuizController::class, 'getOption']);