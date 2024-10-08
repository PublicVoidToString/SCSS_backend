<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Administrator;

class AdministratorController extends Controller
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

        $administrator = new Administrator();
        $administrator->name = $data['name'];
        $administrator->surname = $data['surname'];
        $administrator->save();
        return response()->json(['data'=>$administrator]);
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
        $administrator = Administrator::find($id);
        if($administrator != null){
            $administrator->name = $data['name'];
            $administrator->surname = $data['surname'];
            $administrator->save();
            return response()->json(['data'=>[]]);
        }
        return response()->json(['data'=>[]]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $administrator = Administrator::find($id);
        if($administrator != null){
            $administrator->delete();
            return response()->json(['data'=>$administrator]);
        }else
        return response()->json(['data'=>[]]);
    }
}
