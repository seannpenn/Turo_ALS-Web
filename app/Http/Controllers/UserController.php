<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    
    public function showAllUsers(){
        $userModel = new User();
        $userCollection = $userModel->getAllUsers();
        // $studentCollection = Student::get();

        // dd($studentCollection);
        // return view('dashboard.allusers')->with(compact('userCollection'));
        $response = ['users' => $userCollection];
        return response()->json($response, 200);
    }

    public function delete($id){
        $selectedUser = User::findOrFail($id);
        // return view('deleteStudent')->with(compact('selectedStudent'));
        $selectedUser->delete();
        return redirect()->to(route('users.all'));
    }
}
