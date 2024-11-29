<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offer;
use App\Models\Employer;
use Illuminate\Support\Facades\Auth;

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

    public function getOffersByEmployerId($employerId)
    {
        $offers = Offer::where('employer_id', $employerId)->get();
        return response()->json($offers);
    }

    public function getMyOffers(Request $request)
    {
        $user = Auth::guard('user')->user();
        $employerId = $user->data_id;
    
        $employer = Employer::find($employerId);
    
        if ($employer == null) {
            return response()->json(['error' => 'Employer not found'], 404);
        }
        $offers = Offer::where('employer_id', $employer->id)->get();
        return response()->json($offers);
    }

    public function getOffersByListOfferIds(array $listOfferIds)
    {
        // Validate input to ensure it's an array and not empty
        if (empty($listOfferIds) || !is_array($listOfferIds)) {
            return response()->json(['error' => 'Invalid or empty list of Offer IDs'], 400);
        }

        // Retrieve offers where the ID matches any of the given Offer IDs
        $offers = Offer::whereIn('id', $listOfferIds)->get();

        // Return the offers as a JSON response
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
        
        $user = Auth::guard('user')->user();
        $employerId = $user->data_id;
    
        $employer = Employer::find($employerId);

        // Validate the request data
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'expiration_date' => 'required|date',
        ]);

        // Create a new offer
        $offer = new Offer();
        $offer->employer_id = $employer->id;
        $offer->title = $data['title'];
        $offer->description = $data['description'];
        $offer->expiration_date = $data['expiration_date'];
        $offer->save();

        // Return the created offer as JSON
        return response()->json(['data' => $offer]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Fetch the offer by ID
        $offer = Offer::find($id);
        if ($offer) {
            return response()->json(['data' => $offer]);
        } else {
            return response()->json(['error' => 'Offer not found'], 404);
        }
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
        if ($offer != null) {
            $offer->employer_id = $data['employer_id'];
            $offer->title = $data['title'];
            $offer->description = $data['description'];
            $offer->expiration_date = $data['expiration_date'];
            $offer->save();
            return response()->json(['data' => []]);
        }
        return response()->json(['data' => []]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $offer = Offer::find($id);
        if ($offer != null) {
            $offer->delete();
            return response()->json(['data' => $offer]);
        } else
            return response()->json(['data' => []]);
    }
}
