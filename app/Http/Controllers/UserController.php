<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function showCurrentUser(){
        $userData = Auth::user();
        $ownedCourses = Course::where('teacher_id', Auth::id())->get()->toArray();
        
        return view('home.home')->with(compact('ownedCourses'));
        
    }
    public function showAllUsers(){
        $userModel = new User();
        $userCollection = $userModel->getAllUsers();
        // $studentCollection = Student::get();

        // dd($studentCollection);
        return view('dashboard.allusers')->with(compact('userCollection'));
    }

    public function delete($id){
        $selectedUser = User::findOrFail($id);
        // return view('deleteStudent')->with(compact('selectedStudent'));
        $selectedUser->delete();
        return redirect()->to(route('users.all'));
    }
}
