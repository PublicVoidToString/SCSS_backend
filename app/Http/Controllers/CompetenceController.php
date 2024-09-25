<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Competence;

class CompetenceController extends Controller
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

        $competence = new Competence();
        $competence->name = $data['name'];
        $competence->description = $data['description'];
        $competence->save();
        return response()->json(['data'=>$competence]);
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
        $competence = Competence::find($id);
        if($competence != null){
            $competence->name = $data['name'];
            $competence->description = $data['description'];
            $competence->save();
            return response()->json(['data'=>[]]);
        }
        return response()->json(['data'=>[]]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $competence = Competence::find($id);
        if($competence != null){
            $competence->delete();
            return response()->json(['data'=>$competence]);
        }else
        return response()->json(['data'=>[]]);
    }
}
