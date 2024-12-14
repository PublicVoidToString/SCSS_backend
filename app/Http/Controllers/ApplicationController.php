<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;

class ApplicationController extends Controller
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
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'student_id' => 'required',
            'offer_id' => 'required',
            'cv' => 'required|file|mimes:pdf|max:2048',
        ]);
         // Store CV
        $cvPath = $request->file('cv')->store('cvs', 'public');

         // Create Application
        $application = Application::create([
             'student_id' => $data['student_id'],
             'offer_id' => $data['offer_id'],
             'cv' => $cvPath,
        ]);
 
        return response()->json(['message' => 'Application submitted successfully!', 'application' => $application], 201);
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

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $blacklist = BlackList::find($id);
        if($blacklist != null){
            $blacklist->delete();
            return response()->json(['data'=>[]]);
        }
        return response()->json(['data'=>[]]);
    }
}
