<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OfferCompetence;

class OfferCompetenceController extends Controller
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

        $offer_competence = new OfferCompetence();
        $offer_competence->offer_id = $data['offer_id'];
        $offer_competence->competence_id = $data['competence_id'];
        $offer_competence->save();
        return response()->json(['data'=>$offer_competence]);
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
        $offer_competence = OfferCompetence::find($id);
        if($offer_competence != null){
            $offer_competence->offer_id = $data['offer_id'];
            $offer_competence->competence_id = $data['competence_id'];
            $offer_competence->save();
            return response()->json(['data'=>[]]);
        }
        return response()->json(['data'=>[]]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $offer_competence = OfferCompetence::find($id);
        if($offer_competence != null){
            $offer_competence->delete();
            return response()->json(['data'=>$offer_competence]);
        }else
        return response()->json(['data'=>[]]);
    }
}
