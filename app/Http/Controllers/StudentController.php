<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validated();

        $student = new Student();
        $student->name = $data['name'];
        $student->surname = $data['surname'];
        $student->indexnumber = $data['indexnumber'];
        $student->description = $data['description'];
        $student->photourl = $data['photourl'];

        $student->save();
        return response()->json(['data'=>$student]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validated();
        $student = Student::find($id);
        if($student != null){
            $student->name = $data['name'];
            $student->surname = $data['surname'];
            $student->indexnumber = $data['indexnumber'];
            $student->description = $data['description'];
            $student->photourl = $data['photourl'];
            $student->save();
            return response()->json(['data'=>[]]);
        }
        return response()->json(['data'=>[]]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $student = Student::find($id);
        if($student != null){
            $student->delete();
            return response()->json(['data'=>$student]);
        }else
        return response()->json(['data'=>[]]);
    }
}
