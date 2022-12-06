<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assignment;
use App\Models\AssignmentSubmission;
use App\Models\AssignmentSubmissionText;
use App\Models\AssignmentSubmissionFile;
use App\Models\Enrollment;
use App\Models\Student;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
class AssignmentController extends Controller
{
    public function create(Request $request){
        $rules = [
            'assignment_title' => 'required',
        ];

        $messages = [
            'assignment_title.required' => 'Please input an assignment title',
        ];

        $validation = Validator::make($request->input(), $rules, $messages);

        if($validation->fails()){
            return redirect()->back()->withInput()->withErrors($validation);
        }
        else{
            $assignmentId = Assignment::insertGetId([
                'course_id' => $request->course_id,
                'assignment_title' => $request->assignment_title,
                'assignment_description' => $request->assignment_description,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'submission_type' => $request->submission_type,
            ]);

            return redirect()->to("/teacher/course/".$request->course_id."/assignment/".$assignmentId);
        }
    }

    public function update($assignmentid, Request $request){
        $chosenAssignment = Assignment::where('assignment_id',$assignmentid)->get()->first();

        $chosenAssignment->update([
            'assignment_title' => $request->assignment_title,
            'assignment_description' => $request->assignment_description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'points' => (int)$request->points,
            'submission_type' => $request->submission_type,
            
        ]);

        return $this->successResponse("Assignment updated successfully", $chosenAssignment);
    }
    
    public function delete($assignmentid){
        $selectedAssignment = Assignment::findOrFail($assignmentid);
        $selectedAssignment->delete();
        return back();
    }

    public function getAllAssignments($courseid, Request $request){
        $assignment = new Assignment();

        $assignmentCollection = $assignment->getAssignmentByCourse($courseid);
        if($request->ajax()){
            return $this->successResponse("Assignment collection retrieved successfully", $assignmentCollection);
        }

        return view('dashboard.assignment.display')->with(compact('assignmentCollection'));
    }

    public function viewAssignment($courseId, $assignmentid){
        $assignment = new Assignment();
        $chosenAssignment = $assignment->where('assignment_id', $assignmentid)->get()->first();
        $enrolledStudents = Enrollment::getEnrolleesByLocProg(Auth::user()->teacher->loc_id, Auth::user()->teacher->prog_id);

        return view('dashboard.assignment.view')->with(compact('chosenAssignment', 'enrolledStudents'));
    }
    public function viewSubmissionsByStudent($courseid,$assignmentid, $studentid ){
        $assignment = new Assignment();
        $chosenAssignment = $assignment->where('assignment_id', $assignmentid)->get()->first();
        $student = new Student();
        $chosenStudent = $student->where('student_id', $studentid)->get()->first();

        $studentSubmission = $chosenAssignment->submissionByStudent($studentid);

        return view('dashboard.assignment.viewSubmission')->with(compact('studentSubmission', 'chosenStudent'));
    }

    public function activateorDeactivate($assignmentId){
        $validateNumofSubmissions = 0;
        $chosenAssignment = Assignment::where('assignment_id',$assignmentId)->get()->first();
        
        if($chosenAssignment->start_date != null && $chosenAssignment->end_date != null && 
            $chosenAssignment->start_time != null && $chosenAssignment->end_time != null &&
            $chosenAssignment->submission_type != null && $validateNumofSubmissions == 0){

            if($chosenAssignment->status == 'active'){
                $chosenAssignment->update([
                    'status' => 'inactive',
                ]);
                return $this->successResponse("Status updated successfully", $chosenAssignment);
            }
            else{
                $chosenAssignment->update([
                    'status' => 'active',
                ]);
                return $this->successResponse("Status updated successfully", $chosenAssignment);
            }
        }
        return $this->errorResponse("Status updated unsuccessful. Complete setting up the assignment first.", null);
    }
    public function deleteSubmission($submissionId){
        
        $selectedSubmission = AssignmentSubmission::findOrFail($submissionId);
        if($selectedSubmission->submission_type == 2){
            $directory = 'public/files/assignments/submissions/'.$selectedSubmission->submission_id;
            Storage::deleteDirectory($directory);
        }
        $selectedSubmission->delete();

        return back();
    }
    public function markAssignment($submissionId, Request $request){
        $selectedSubmission = AssignmentSubmission::where('submission_id',$submissionId)->get()->first();

        $selectedSubmission->update([
            "total_score" => $request->total_score,
        ]);

        return $this->successResponse("Submission marked successfully", $selectedSubmission);
    }








    // For students

    public function studentGetAllAssignment($courseid){
        $assignment = new Assignment();
    
        $assignmentCollection = $assignment->getAssignmentByCourse($courseid)->where('status', 'active');
    
        return view('student.assignments.display')->with(compact('assignmentCollection'));
    }

    public function studentViewAssignment($courseid, $assignmentid){
        $assignment = new Assignment();
    
        $chosenAssignment = $assignment->where('assignment_id', $assignmentid)->where('status', 'active')->get()->first();
        return view('student.assignments.view')->with(compact('chosenAssignment'));
    }
    public function submitAssignment($assignmentId, Request $request){
        $submissionId = AssignmentSubmission::insertGetId([
            'assignment_id' => $request->assignment_id,
            'student_id' => Auth::user()->student->student_id,
            'submission_type' => $request->submission_type,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        if($request->submission_type == 1){
            $submissionText = AssignmentSubmissionText::create([
                'submission_id' => $submissionId,
                'text' => $request->text,
            ]);
        }
        else{
                $fileRequest = $request->file;
                $originalFileName = $fileRequest->getClientOriginalName();
                
                // dd(asset('topic-'. $request['topic_id']. '/'.$originalFileName));
                Storage::putFileAs('public/files/assignments/submissions/'. $submissionId . '/', $fileRequest, $originalFileName);
                $path = 'storage/files/assignments/submissions/'. $submissionId . '/' .$originalFileName;

                $submissionFile = AssignmentSubmissionFile::create([
                    'submission_id' => $submissionId,
                    'path' => $path,
                ]);
        }
        return redirect()->to("/student/course/".$request->course_id."/assignment/".$request->assignment_id."/submissions");
    }
    public function viewSubmissions($courseid,$assignmentid){
        $assignment = new Assignment();

        $assignment = $assignment->where('assignment_id', $assignmentid)->get()->first();
        $assignmentSubmissions = $assignment->submissions;
        return view('student.assignments.submissions')->with(compact('assignmentSubmissions'));
    }
}
