<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employer;

class EmployerController extends Controller
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
        // Walidacja danych pracodawcy
        $data = $request->validate([
            'krsnumber' => 'required|string|max:20',
            'companyname' => 'required|string|max:255',
        ]);

        // Tworzenie rekordu pracodawcy
        $employer = Employer::create($data);

        // Przypisanie data_id w tabeli users do id pracodawcy
        $user = User::find($userId);
        $user->data_id = $employer->id;
        $user->save();

        return response()->json(['data' => $employer], 201);
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
        $employer = employer::find($id);
        if($employer != null){
            $employer->company_name = $data['companyname'];
            $employer->krs_number = $data['krsnumber'];
            $employer->save();
            return response()->json(['data'=>[]]);
        }
        return response()->json(['data'=>[]]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employer = employer::find($id);
        if($employer != null){
            $employer->delete();
            return response()->json(['data'=>$employer]);
        }else
        return response()->json(['data'=>[]]);
    }
}
