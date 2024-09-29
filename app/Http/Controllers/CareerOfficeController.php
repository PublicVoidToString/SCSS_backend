<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CareerOffice;

class CareerOfficeController extends Controller
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
    public function store(Request $request, $userId)
    {
        // Walidacja danych biura karier
        $data = $request->validate([
            'university' => 'required|string|max:255',
        ]);

        // Tworzenie rekordu biura karier
        $career_office = CareerOffice::create($data);

        // Przypisanie data_id w tabeli users do id biura karier
        $user = User::find($userId);
        $user->data_id = $career_office->id;
        $user->save();

        return response()->json(['data' => $career_office], 201);
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
        $career_office = CareerOffice::find($id);
        if($career_office != null){
            $career_office->university = $data['university'];
            $career_office->save();
            return response()->json(['data'=>[]]);
        }
        return response()->json(['data'=>[]]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $career_office = CareerOffice::find($id);
        if($career_office != null){
            $career_office->delete();
            return response()->json(['data'=>$career_office]);
        }else
        return response()->json(['data'=>[]]);
    }
}
