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

    //for students announcements
    public function announcement(){
        $announcementCollection = Announcement::getAllAnnouncements();
        return view('student.student_dashboard')->with(compact('announcementCollection'));
    }
    
    //edit announcement
    public function update(Request $request){
        $rules = [
            'announcement_title' => 'required',
            'announcement_description' => 'required',
        ];

        $messages = [
            'announcement_title.required' => 'Please input announcement title.',
            'announcement_description.required' => 'Please input announcement description.',
        ];

        $validation = Validator::make($request->input(), $rules, $messages);


        if($validation->fails()){
            return redirect()->back()->withInput()->withErrors($validation);
        }
        else{
            $updateCourse = Announcement::where('announcement_id',$request->announcement_id);
            $updateCourse->update([
                'announcement_title' => $request->announcement_title,
                'announcement_description' => $request->announcement_description,
            ]);
            
            return back();
        }
    }   

    public function delete($id){
        $announcement = Announcement::findOrFail($id);
        $announcement->delete();
        return redirect()->to(route('announcement.all', $announcement->announcement_id));
    }
}
