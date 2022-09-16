<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function showAllUsers(){
        $userModel = new User();
        $userCollection = $userModel->getAllUsers();
        return view('admin.allusers')->with(compact('userCollection'));
    }
    // public function viewProfile($id){
    //     $userData = User::where('id', $id)->get();  
    // }
    public function delete($id){
        $selectedUser = User::findOrFail($id);
        $selectedUser->delete();
        return redirect()->to(route('users.all'));
    }
}
