<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EducationMaterials;
use App\Models\User;
class EducationMaterialsController extends Controller
{
    public function addEducationMaterial(Request $request)
    {
        $request->validate([
            'description' => 'required|string',
            'title' => 'required|string|max:255',
        ]);

        if (auth()->user()->role_id != User::ROLE_CAREEROFFICE) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $careerOfficeId = auth()->user()->data_id;

        $material = EducationMaterials::create([
            'career_office_id' => $careerOfficeId,
            'description' => $request->description,
            'title' => $request->title,
        ]);

        return response()->json($material);
    }


    public function listMyMaterials()
    {
        if (auth()->user()->role_id != User::ROLE_CAREEROFFICE) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $materials = EducationMaterials::where('career_office_id', auth()->user()->data_id)->get();

        return response()->json($materials);
    }

    public function listAllMaterials()
    {
        $materials = EducationMaterials::with('careerOffice')->get();

        return response()->json($materials);
    }

    public function deleteMyMaterial($id)
    {
        if (auth()->user()->role_id != User::ROLE_CAREEROFFICE) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $material = EducationMaterials::where('id', $id)
            ->where('career_office_id', auth()->user()->data_id)
            ->first();

        if (!$material) {
            return response()->json(['error' => 'Material not found or unauthorized'], 404);
        }

        $material->delete();

        return response()->json(['message' => 'Material deleted successfully']);
    }
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $material = EducationMaterials::findOrFail($id);
        $material->update($data);

        return response()->json($material);
    }
}
