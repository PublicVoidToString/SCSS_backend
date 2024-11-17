<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EducationMaterials;

class EducationMaterialsController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        // Fetch all offers from the database
        $educational_materials = EducationMaterials::all();

        // Return the offers, you can return them as JSON or pass them to a view
        return response()->json($educational_materials);
    }

    public function listEducationalMaterialsByCareerOfficeId($career_office_id)
    {
        $educational_materials = EducationMaterials::where('career_office_id', $career_office_id)->get();
        return response()->json($educational_materials);
    }

    public function listSingleEducationalMaterial($id)
    {
        $educational_material = EducationMaterials::find($id);
        return response()->json($educational_material);
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
        // Validate the request data
        $data = $request->validate([
            'career_office_id' => 'required|integer',  // Assuming 'career_offices' is the related table
            'description' => 'required|string',
        ]);

        // Create a new offer
        $educational_material = new EducationMaterials();
        $educational_material->career_office_id = $data['career_office_id'];
        $educational_material->description = $data['description'];
        $educational_material->save();

        // Return the created offer as JSON
        return response()->json(['data' => $educational_material]);
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
        $educational_material = EducationMaterials::find($id);
        if($educational_material != null){
            $educational_material->career_office_id = $data['career_office_id'];
            $educational_material->description = $data['description'];
            $educational_material->save();
            return response()->json(['data'=>[]]);
        }
        return response()->json(['data'=>[]]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $educational_material = EducationMaterials::find($id);
        if($educational_material != null){
            $educational_material->delete();
            return response()->json(['data'=>$educational_material]);
        }else
        return response()->json(['data'=>[]]);
    }
}
