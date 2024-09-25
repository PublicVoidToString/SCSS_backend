<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentCompetence;

class StudentCompetenceController extends Controller
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

        $student_competence = new StudentCompetence();
        $student_competence->student_id = $data['student_id'];
        $student_competence->competence_id = $data['competence_id'];
        $student_competence->save();
        return response()->json(['data'=>$student_competence]);
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
        $student_competence = StudentCompetence::find($id);
        if($student_competence != null){
            $student_competence->student_id = $data['student_id'];
            $student_competence->competence_id = $data['competence_id'];
            $student_competence->save();
            return response()->json(['data'=>[]]);
        }
        return response()->json(['data'=>[]]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $student_competence = StudentCompetence::find($id);
        if($student_competence != null){
            $student_competence->delete();
            return response()->json(['data'=>$student_competence]);
        }else
        return response()->json(['data'=>[]]);
    }
}
