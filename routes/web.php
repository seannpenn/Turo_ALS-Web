<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseContentController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\TeacherController;
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
Route::view('/', 'landing')->name('landing');
Route::view('/test', 'test')->name('test');

Route::prefix('admin')->middleware(['auth','isAdmin'])->group(function(){

    Route::view('/home', 'home.teacher_home')->name('teacher.home');

    Route::get('/users/all', [UserController::class, 'showAllUsers'])->name('users.all');
    Route::get('/teachers/all', [TeacherController::class, 'testing'])->name('teachers.all');
    // For students

    Route::get('/students/records', [StudentController::class, 'showAllStudents'])->name('students.all');
    Route::get('student/application/{id}',[StudentController::class, 'showStudentApplication'])->name('student.application');
    Route::post('student/application/approve/{id}',[StudentController::class, 'approve'])->name('student.approve');
    Route::get('/students/records', [StudentController::class, 'showAllStudents'])->name('students.all');
    Route::post('student/application/provideLRN/{id}',[StudentController::class, 'provideLRN'])->name('student.provideLRN');


    // For create courses
    Route::post('/course/create', [CourseController::class, 'create'])->name('course.create');
    Route::get('/course/all', [CourseController::class, 'showOwnedCourses'])->name('course.all');
    Route::get('/course/{id}', [CourseController::class,'showCourse'])->name('course.showInfo');
    Route::post('/course/{id}/update', [CourseController::class, 'update'])->name('course.update');
    Route::get('/course/{id}/delete', [CourseController::class,'delete'])->name('course.delete');

    // for create course content
    Route::post('/course/content/create', [CourseContentController::class, 'create'])->name('content.create');
    Route::get('/course/content/{id}/delete', [CourseContentController::class, 'delete'])->name('content.delete');
    Route::get('/course/content/{id}', [CourseContentController::class, 'viewModule'])->name('content.view');
    Route::post('/course/content/{id}/update', [CourseContentController::class, 'update'])->name('content.update');

    // for create content topic

    Route::post('/course/content/topic/create', [TopicController::class, 'create'])->name('topic.create');
    Route::get('/course/content/topic/{topicid}', [TopicController::class, 'viewModuleTopics'])->name('topic.view');
    Route::get('/course/content/topic/{topicid}/delete', [TopicController::class, 'delete'])->name('topic.delete');

    // for quiz make
    Route::view('/quiz/create', 'dashboard.quiz.create')->name('quiz.create');
    Route::get('/quiz/edit/{id}', [QuizController::class, 'edit'])->name('quiz.edit');
    Route::post('/quiz/update/{id}', [QuizController::class, 'update'])->name('quiz.update');
    Route::post('/quiz/create/{id}', [QuizController::class, 'create'])->name('quiz.store');
    Route::get('/quiz/manage', [QuizController::class, 'manage'])->name('quiz.manage');
    // ^
    //for question
    Route::post('/quiz/question/create', [QuizController::class, 'createQuestion'])->name('question.create');
    Route::get('/quiz/question/delete/{id}', [QuestionController::class, 'delete'])->name('question.delete');
    Route::post('/quiz/question/update/{id}', [QuestionController::class, 'update'])->name('question.update');

    // for pdf upload
    // Route::get('file/upload',[TopicController::class, 'uploadFiles'])->name('topic.upload');
    Route::post('file/upload', [TopicController::class, 'storeUploadedFiles'])->name('topic.store');
});



//for login and register routes
Route::view('/admin', 'login.teacher_login')->name('t-login');
Route::view('/student/login', 'login.student_login')->name('s-login');
Route::post('/teacher/login', [LoginController::class, 'teacherLogin'])->name('teacher.login');
Route::post('/student/login', [LoginController::class, 'studentLogin'])->name('student.login');
Route::get('/logout', [LoginController::class, 'logout'])->name('user.logout');

Route::view('/register/teacher', 'login.teacher_registration')->name('teacher.registration');
Route::view('/register/student', 'login.student_registration')->name('student.registration');
Route::post('/teacher/register', [RegisterController::class, 'teacherRegister'])->name('teacher.register');
Route::post('/student/register', [RegisterController::class, 'studentRegister'])->name('student.register');



Route::middleware(['auth'])->group(function(){
    // For student routes
    // For user routes
    Route::view('/student/home', 'home.student_home')->name('student.home');
    Route::view('/student/profile', 'profile.student_profile')->name('student.profile');
    Route::get('user/{id}/delete',[UserController::class,'delete'])->name('user.delete');
    // Route::post('/course/content/create', [CourseContentController::class, 'create'])->name('content.delete');
    
});
