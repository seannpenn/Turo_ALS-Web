<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use App\Models\Course;
use App\Models\CourseContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class CourseContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CourseContent  $courseContent
     * @return \Illuminate\Http\Response
     */
    public function show($courseID)
    {

        
        
        $selectedCourse = Course::findOrFail($courseID);
        $moduleCollection = $selectedCourse->coursecontent->toArray();
    
        return response()->json([

            'status' =>true,
            'coursecontent' => $moduleCollection
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CourseContent  $courseContent
     * @return \Illuminate\Http\Response
     */
    public function edit(CourseContent $courseContent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CourseContent  $courseContent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CourseContent $courseContent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CourseContent  $courseContent
     * @return \Illuminate\Http\Response
     */
    public function destroy(CourseContent $courseContent)
    {
        //
    }
}
