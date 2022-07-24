<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Program;
use App\Models\College;

use Validator;
class StudentController extends Controller
{

    private $years = [
        '1' => 'First Year',
        '2' => 'Second Year',
        '3' => 'Third Year',
        '4' => 'Fourth Year',
        '5' => 'Fifth Year' 
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        echo 'This is the index page for students';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $programs = Program::getProgramsByCollege(1);    

        // $programs = [
        //     'BSCS' => 'Bachelor of Science in Computer Science',     
        //     'BSIT' => 'Bachelor of Science in Information Technology',
        //     'BSEMC' => 'Bacheloor od Science in Entertainment and Multimedia Computing'
        // ];

        $years = $this->years;

        //
        return view('addstudent')->with(compact('programs','years'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $rules = [
            'studid' => 'required|regex:/[0-9]+/|unique:student,studid',
            'studfname' => 'required',
            'studlname' => 'required',
        ];

        $messages = [
            'studid.required' => 'Please input a student ID number.',
            'studid.regex' => 'Student ID should be numeric.',
            'studid.unique' => 'Student ID already exists.',
            'studfname.required' => 'Please input your first name.',
            'studlname.required' => 'Please input your last name.',

        ];

        $validation = Validator::make($request->input(), $rules, $messages);


        if($validation->fails()){
            return redirect()->back()->withInput()->withErrors($validation);
        }
        else{
            // $college = new College;
            $findCollege = Program::where('prog_id',$request->studprogramid)->get()->first();
            $newStudent = new Student;

        $newStudent->studid = $request->studid;
        $newStudent->studfname = $request->studfname;
        $newStudent->studlname = $request->studlname;
        $newStudent->studprogramid = $request->studprogramid;
        $newStudent->studcollegeid = $findCollege->prog_coll;
        $newStudent->studyear = $request->studyear;
        
        $newStudent->save();

        // return redirect()->to(url('students/all'));
        return redirect()->to(url('/home'));
        }
        
        // return redirect()->to(route('students.all'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        // echo 'Displaying a student listing';
        // $studentData = Student::findOrFail($id);
        $studentData = Student::where('studid',$id)->get()->toArray();
        // var_dump($studentData);
        if($studentData){
            // $studentData = $studentData[0];
            return view('found')->with(compact('studentData'));
        }
        else{
            return view('notfound');
        }
        
        // $totalNumber = count($this->students) - 1;

        // if($id > $totalNumber ){
        //     return view('notfound');
        // }
        // else{
        //     $data = $this->students[$id];
             
        //     // var_dump($data);
        // }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        // echo 'Update student information.';

        // $student= Student::where('studid', $id)->first();
        //     return view('editstudent')->with(compact('student'));

        $programs = Program::getProgramsByCollege(1);
        $student = Student::findOrFail($id)->toArray();
        $years = $this->years;
        return view('editstudent')->with(compact('student' ,'programs', 'years'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $rules = [
            'studfname' => 'required',
            'studlname' => 'required',
        ];

        $messages = [
            'studfname.required' => 'Please input your first name.',
            'studlname.required' => 'Please input your last name.',

        ];

        $validation = Validator::make($request->input(), $rules, $messages);


        if($validation->fails()){
            return redirect()->back()->withInput()->withErrors($validation);
        }
        else{

        $findCollege = Program::where('prog_id',$request->studprogramid)->get()->first();

        $updateStudent = Student::findorFail($id);
        $updateStudent->update([
                                    'studfname' => $request->studfname,
                                    'studmname' => $request->studmname,
                                    'studlname' => $request->studlname,
                                    'studprogramid' => $request->studprogramid,
                                    'studcollegeid' => $findCollege->prog_coll,
                                    'studyear' => $request->studyear
        ]);

        return redirect()->to(url('students/all'));
        }
        
        return redirect()->to(route('students.all'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        //
        // 
        $selectedStudent = Student::findOrFail($id);
        return view('deleteStudent')->with(compact('selectedStudent'));
        // $deleteStudent->delete();
        // return redirect()->to(url('students/all'));
    }

    public function destroy($id)
    {
        //
        // 
        $selectedStudent = Student::findOrFail($id);
        // return view('deleteStudent')->with(compact('selectedStudent'));
        $selectedStudent->delete();
        return redirect()->to(url('students/all'));
    }

    public function showAll(){
        $studentModel = new Student();
        $studentCollection = $studentModel->getAllStudents();
        // $studentCollection = Student::get();

        // dd($studentCollection);
        return view('showallstudents')->with(compact('studentCollection'));
    }
}
