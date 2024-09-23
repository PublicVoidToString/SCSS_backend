<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Collaboration;

class CollaborationController extends Controller
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

        $collaboration = new Collaboration();
        $collaboration->career_office_id = $data['careeroffice_id'];
        $collaboration->employer_id = $data['employer_id'];
        $collaboration->save();
        return response()->json(['data'=>$collaboration]);
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
        $collaboration = Collaboration::find($id);
        if($collaboration != null){
            $collaboration->career_office_id = $data['careeroffice_id'];
            $collaboration->employer_id = $data['employer_id'];
            $collaboration->save();
            return response()->json(['data'=>[]]);
        }
        return response()->json(['data'=>[]]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $collaboration = Collaboration::find($id);
        if($collaboration != null){
            $collaboration->delete();
            return response()->json(['data'=>$collaboration]);
        }else
        return response()->json(['data'=>[]]);
    }
}
