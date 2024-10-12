<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offer;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all offers from the database
        $offers = Offer::all();
        
        // Return the offers, you can return them as JSON or pass them to a view
        return response()->json($offers);
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
        'employer_id' => 'required|integer',  // Assuming 'employers' is the related table
        'title' => 'required|string|max:255',
        'description' => 'required|string',
    ]);

    // Create a new offer
    $offer = new Offer();
    $offer->employer_id = $data['employer_id'];
    $offer->title = $data['title'];
    $offer->description = $data['description'];
    $offer->save();

    // Return the created offer as JSON
    return response()->json(['data' => $offer]);
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
        $offer = Offer::find($id);
        if($offer != null){
            $offer->employer_id = $data['employer_id'];
            $offer->title = $data['title'];
            $offer->description = $data['description'];
            $offer->save();
            return response()->json(['data'=>[]]);
        }
        return response()->json(['data'=>[]]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $offer = Offer::find($id);
        if($offer != null){
            $offer->delete();
            return response()->json(['data'=>$offer]);
        }else
        return response()->json(['data'=>[]]);
    }
}
