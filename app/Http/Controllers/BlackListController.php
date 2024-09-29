<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlackList;

class BlackListController extends Controller
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
    public function store(Request $request, $userId)
    {
        $data = $request->validated();
        $blacklist = new BlackList();
        $blacklist->user_id = $userId;
        $blacklist->save();
        return response()->json(['data'=>$blacklist]);
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
