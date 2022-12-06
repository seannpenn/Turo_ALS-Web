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
use App\Http\Controllers\TopicContentController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\OptionController;
use App\Events\Questions;
use App\Http\Controllers\AssignmentController;

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

Route::view('/test', 'test')->name('test');
Route::view('/', 'landing')->name('home');
Route::prefix('admin')->middleware(['auth','isAdmin'])->group(function(){
    Route::get('/users/all', [UserController::class, 'showAllUsers'])->name('users.all');
    Route::view('/', 'home.admin_home')->name('admin.home');

    // for announcements
    Route::get('announcement/all', [AnnouncementController::class, 'view'])->name('announcement.all');
    Route::post('announcement/create', [AnnouncementController::class, 'create'])->name('announcement.create');
    Route::get('/announcement/{id}/delete', [AnnouncementController::class,'delete'])->name('announcement.delete');
    Route::post('/announcement/update', [AnnouncementController::class, 'update'])->name('announcement.update');
});


Route::prefix('teacher')->middleware(['auth','isTeacher'])->group(function(){

    Route::view('/home', 'home.teacher_home')->name('teacher.home');

    
    Route::get('/teachers/all', [TeacherController::class, 'testing'])->name('teachers.all');

    // For teacher 

    Route::view('/profile', 'profile.teacher_profile')->name('teacher.profile');

    // For students
    Route::get('/students/records', [StudentController::class, 'showAllStudents'])->name('students.all');
    Route::get('student/application/{id}',[StudentController::class, 'showStudentApplication'])->name('student.application');
    Route::post('student/application/approve/{id}',[StudentController::class, 'approve'])->name('student.approve');
    Route::get('/students/records', [StudentController::class, 'showAllStudents'])->name('students.all');
    Route::post('student/application/provideLRN/{id}',[StudentController::class, 'provideLRN'])->name('student.provideLRN');


    // For create courses
    Route::post('/course/create', [CourseController::class, 'create'])->name('course.create');
    Route::get('/course/all', [CourseController::class, 'showOwnedCourses'])->name('course.all');
    Route::get('/course/getAll', [CourseController::class, 'getCourses'])->name('course.getAll');
    Route::get('/course/{courseid}/content', [CourseController::class, 'showAll'])->name('course.displayAll'); //important
    Route::get('/course/{courseid}/home', [CourseController::class,'showCourse'])->name('course.showInfo');
    Route::post('/course/{courseid}/update', [CourseController::class, 'update'])->name('course.update');
    Route::get('/course/{courseid}/delete', [CourseController::class,'delete'])->name('course.delete');

    // for create course content
    Route::post('/course/content/create', [CourseContentController::class, 'create'])->name('content.create');
    Route::get('/course/{courseid}/content/getAll/', [CourseContentController::class, 'getModules'])->name('content.getAll');
    Route::get('/course/content/{id}/delete', [CourseContentController::class, 'delete'])->name('content.delete');
    Route::get('/course/{courseid}/content/{contentid}', [CourseContentController::class, 'viewModule'])->name('content.view'); //important
    Route::post('/course/content/{id}/update', [CourseContentController::class, 'update'])->name('content.update');

    // for create content topic
    Route::post('/course/topic/create', [TopicController::class, 'create'])->name('topic.create');
    Route::get('/course/content/topic/{topicid}/delete', [TopicController::class, 'delete'])->name('topic.delete');
    Route::post('course/topic/update/test', [TopicController::class, 'update'])->name('topic.update');
    
    Route::get('course/{courseid}/topic/{topicid}', [TopicController::class, 'viewTopic'])->name('topic.view'); //important
    

    // for create topic content
    Route::get('/course/content/topic/content/{id}/delete', [TopicContentController::class, 'delete'])->name('topicContent.delete');
    Route::post('/course/content/topic/content/create', [TopicContentController::class, 'create'])->name('topicContent.create');
    Route::get('/course/{courseid}/topiccontent/{topiccontentid}', [TopicContentController::class, 'viewTopicContent'])->name('topicContent.view'); //important
    Route::get('/course/{courseid}/content/{contentid}/topic/{topicid}/content/{topiccontentid}', [TopicContentController::class, 'retainTopicContent'])->name('topicContent.retain');//important
    Route::post('/course/content/topic/content/{contentid}/update', [TopicContentController::class, 'update'])->name('topicContent.update');
    Route::get('/course/{courseid}/topic/{topicid}/topicContent/choices', [TopicContentController::class, 'topicChoices'])->name('topicContent.choices');
    Route::get('/course/content/topic/content/{id}/create/html',     [TopicContentController::class, 'createHtml'])->name('html.create');
    Route::get('/course/content/topic/content/{id}/create/file', [TopicContentController::class, 'createFile'])->name('file.create');
    Route::get('/course/content/topic/content/{id}/create/link', [TopicContentController::class, 'createLink'])->name('link.create');
    Route::post('/course/content/topic/content/{id}/link', [TopicContentController::class, 'linkContent'])->name('topicContent.link');
  
    
    // for pdf upload
    // Route::get('file/upload',[TopicController::class, 'uploadFiles'])->name('topic.upload');
    Route::post('file/upload', [TopicController::class, 'storeUploadedFiles'])->name('topic.store');

    // for quiz make
    Route::view('/quiz/create', 'dashboard.quiz.create')->name('quiz.create');
    Route::get('/quiz/delete/{quizid}', [QuizController::class, 'delete'])->name('quiz.delete');
    Route::get('/course/{courseid}/quiz/edit/{quizid}', [QuizController::class, 'edit'])->name('quiz.edit');
    Route::post('/course/{courseid}/quiz/setup/{quizid}', [QuizController::class, 'quizSetup'])->name('quiz.setup');
    Route::post('/quiz/{quizid}/activate', [QuizController::class, 'activateorDeactivate'])->name('quiz.activate');
    Route::post('/quiz/edit/{quizid}/update', [QuizController::class, 'update'])->name('quiz.update');
    Route::post('/quiz/store', [QuizController::class, 'create'])->name('quiz.store');
    Route::get('/course/{courseid}/quiz/manage', [QuizController::class, 'manage'])->name('quiz.manage');
    Route::get('/course/{courseid}/quiz/all',[QuizController::class, 'getAllQuizzes'])->name('quiz.all');
    Route::get('/course/quiz/{quizid}/allAttempts/recalculate', [QuizController::class, 'recalculateScore'])->name('quiz.recalculateScore');
    
    
    Route::get('/course/{courseid}/quiz/get/{quizid}', [QuizController::class, 'getSelectedQuiz'])->name('quiz.get');
    // ^

    //for question
    Route::post('/quiz/question/create', [QuestionController::class, 'create'])->name('question.create'); //for event
    Route::get('/quiz/question/{questionid}', [QuestionController::class, 'getQuestion'])->name('question.get');
    Route::get('/quiz/question/all/{quizid}', [QuestionController::class, 'getAllQuestions'])->name('question.getAll');
    Route::get('/quiz/question/delete/{questionid}', [QuestionController::class, 'delete'])->name('question.delete');
    Route::post('/quiz/question/update/{questionid}', [QuestionController::class, 'update'])->name('question.update');
    Route::post('/quiz/question/update/{questionid}/points', [QuestionController::class, 'updatePoint'])->name('question.updatePoint');
    Route::post('/quizAnswer/{quizanswerid}', [QuestionController::class, 'markAnswer'])->name('questionAnswer.mark');

    // for question option
    Route::post('/quiz/option/update/{optionid}', [OptionController::class, 'update'])->name('option.update');
    Route::post('/quiz/question/option/create', [OptionController::class, 'create'])->name('option.create');
    Route::get('/quiz/question/option/delete/{optionid}', [OptionController::class, 'delete'])->name('option.delete');
    Route::get('/quiz/question/{questionid}/option/delete/all', [OptionController::class, 'deleteAll'])->name('option.deleteAll');
    Route::post('/quiz/question/option/{optionid}/setAnswer', [OptionController::class, 'setAnswer'])->name('option.setAnswer');
    Route::post('/quiz/question/option/consider/{answerid}', [OptionController::class, 'considerAnswer'])->name('answer.consider');
    Route::get('/quiz/question/{questionid}/options', [OptionController::class, 'getOptions'])->name('option.getAll');

    // for assignments
    Route::post('/assignment/create', [AssignmentController::class, 'create'])->name('assignment.create');
    Route::post('/assignment/{assignmentid}/update', [AssignmentController::class, 'update'])->name('assignment.update');
    Route::get('/assignment/{assignmentid}/delete', [AssignmentController::class, 'delete'])->name('assignment.delete');
    // Route::view('/testing/create/{courseid}', 'dashboard.assignment.display')->name('assignment.display');
    Route::get('/course/{courseid}/assignments', [AssignmentController::class, 'getAllAssignments'])->name('assignment.display');
    Route::get('/course/{courseid}/assignment/{assignmentid}', [AssignmentController::class, 'viewAssignment'])->name('assignment.view');
    Route::post('/assignment/{assignmentid}/activate', [AssignmentController::class, 'activateorDeactivate'])->name('assignment.activate');
    Route::get('/course/{courseid}/assignment/{assignmentid}/student/{studentid}/submission', [AssignmentController::class, 'viewSubmissionsByStudent'])->name('assignment.displaySubmissionByStudent');
    Route::post('/assignment/{assignmentid}/mark',[AssignmentController::class, 'markAssignment'])->name('assignment.mark');
    Route::get('/submission/{submissionid}/delete', [AssignmentController::class, 'deleteSubmission'])->name('submission.delete');
});

//for login and register routes
    Route::view('/teacher', 'login.teacher_login')->name('t-login');
    Route::view('/student/login', 'login.student_login')->name('s-login');
    Route::post('/teacher/login', [LoginController::class, 'teacherLogin'])->name('teacher.login');
    Route::post('/student/login', [LoginController::class, 'studentLogin'])->name('student.login');
    Route::get('/logout', [LoginController::class, 'logout'])->name('user.logout');

    Route::get('/register/teacher', [RegisterController::class,'teacherRegistration'])->name('teacher.registration');
    Route::get('/register/student', [RegisterController::class,'studentRegistration'])->name('student.registration');

    Route::post('/teacher/register', [RegisterController::class, 'teacherRegister'])->name('teacher.register');
    Route::post('/student/register', [RegisterController::class, 'studentRegister'])->name('student.register');


Route::get('/quiz/all',[QuizController::class, 'getEntireQuizzes'])->name('quiz.getAll');
Route::middleware('auth')->group(function(){
    // Profile
    
    Route::view('/admin/student/profile', 'admin.viewProfile')->name('admin-student.profile');


    Route::get('/student/enrollment/enroll', [StudentController::class, 'enrollForm'])->name('student.enrollment');
    Route::get('/student/enrollment', [StudentController::class, 'enrollmentPage'])->name('student.enrollment_page');
    Route::post('/student/enrollment', [StudentController::class, 'enroll'])->name('student.enroll');
    Route::view('/student/home', 'home.student_home')->name('student.home');
    Route::view('/student/profile', 'profile.student_profile')->name('student.profile');
    Route::get('user/{id}/delete',[UserController::class,'delete'])->name('user.delete');


    Route::get('/student/announcement', [AnnouncementController::class,'showAnnouncement'])->name('student.student_dashboard');
    Route::get('/student/course/{courseid}/home', [CourseController::class,'studentDisplayModules'])->name('student.courseHome');
    Route::get('/student/course/{courseid}', [CourseController::class,'studentDisplayContent'])->name('student.contentDisplay');
    Route::get('/student/course/{courseid}/modules', [CourseController::class,'studentDisplayModule'])->name('student.student_viewmodule');
    Route::get('/student/course/{courseid}/topiccontent/{topiccontentid}', [TopicContentController::class, 'studentViewTopicContent'])->name('student.topicContent'); //important

    // quiz
    Route::get('/student/course/{courseid}/quizzes', [QuizController::class,'getQuizzes'])->name('student.quizzes');
    Route::get('/student/course/{courseid}/quiz/{quizid}', [QuizController::class,'viewQuiz'])->name('student.viewQuiz');
    Route::get('/student/course/{courseid}/quiz/take/{quizid}', [QuizController::class,'takeQuiz'])->name('student.takeQuiz');
    Route::get('/student/course/{courseid}/quiz/{quizid}/result', [QuizController::class,'viewResult'])->name('student.viewResult');
    Route::post('/student/course/{courseid}/quiz/{quizid}/answers', [QuizController::class,'storeAnswers'])->name('student.storeAnswers');
    Route::post('/student/course/quiz/answer/store', [QuizController::class, 'saveAnswerToSession'])->name('saveAnswerToSession');

    // assignment
    Route::get('/student/course/{courseid}/assignment/display', [AssignmentController::class, 'studentGetAllAssignment'])->name('student.assignmentDisplay');
    Route::get('/student/course/{courseid}/assignment/{assignmentid}', [AssignmentController::class,'studentViewAssignment'])->name('student.viewAssignment');
    Route::post('/student/assignment/{assignmentid}/submit', [AssignmentController::class,'submitAssignment'])->name('student.submitAssignment');
    Route::get('/student/course/{courseid}/assignment/{assignmentid}/submissions', [AssignmentController::class,'viewSubmissions'])->name('student.viewSubmissions');

});


//for students course content page
Route::get('/student/courses', [CourseController::class, 'studentDisplayCourse'])->name('student.course');

Route::get('/student/course/{courseid}/content', [CourseController::class,'studentDisplayContent'])->name('student.student_viewcontent');

//for student topic content page
// Route::get('/student/course/{courseid}/content/{contentid}/topic/{topicid}/content/{topiccontentid}', [TopicContentController::class, 'retainTopicContent'])->name('topicContent.retain');

//for students announcement page


