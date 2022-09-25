<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;
use Carbon\Carbon;
use Validator;

class AnnouncementController extends Controller
{
    public function view()
    {
        $announcementCollection = Announcement::getAllAnnouncements();
        return view('admin.announcement')->with(compact('announcementCollection'));
        
    }

    public function create(Request $request){
        $currentTime = Carbon::now();

        $rules = [
            'announcement_title' => 'required',
        ];

        $messages = [
            'announcement_title.required' => 'Please input an announcement title',
        ];

        $validation = Validator::make($request->input(), $rules, $messages);

        if($validation->fails()){
            return redirect()->back()->withInput()->withErrors($validation);
        }
        else{
    
            $announcement = new Announcement();

            $announcement->date = $currentTime;
            $announcement->announcement_title = $request->announcement_title;
            $announcement->announcement_description = $request->announcement_description;
            $announcement->save();
            
            return back();
        }
    }

    //display for students
    public function showAnnouncement(){
        $announcementCollection = Announcement::getAllAnnouncements();
        return view('student.student_dashboard')->with(compact('announcementCollection'));  
    }
}
