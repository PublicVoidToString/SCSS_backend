<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employer;
use App\Models\Application;
use App\Models\Offer;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class EmployerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Pobieranie tylko niezweryfikowanych pracodawców
        $unverifiedEmployers = Employer::with('user')
            ->where('verified', Employer::NOT_VERIFIED)
            ->orWhereNull('verified')
            ->whereDoesntHave('user.blacklist')
            ->get();

        // Zwracanie danych w formacie JSON
        return response()->json(['data' => $unverifiedEmployers], 200);
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

        $data['verified'] = Employer::NOT_VERIFIED;

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
    /*
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
        */
    public function update(Request $request, string $id)
    {
        // Pobierz zalogowanego użytkownika
        $user = Auth::guard('api')->user();

        // Znajdź pracodawcę na podstawie data_id w tabeli users, które wskazuje na id w tabeli employers
        $employer = Employer::where('id', $id)->where('id', $user->data_id)->first();

        // Sprawdź, czy znaleziono pracodawcę
        if (!$employer) {
            return response()->json(['error' => 'Unauthorized or employer not found'], 403);
        }

        // Walidacja danych
        $validatedData = $request->validate([
            'companyname' => 'required|string|max:255',
            'krsnumber' => 'required|string|max:255',
        ]);

        // Aktualizacja danych pracodawcy
        $employer->company_name = $validatedData['companyname'];
        $employer->krs_number = $validatedData['krsnumber'];
        $employer->save();

        return response()->json(['message' => 'Employer updated successfully']);
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employer = employer::find($id);
        if ($employer != null) {
            $employer->delete();
            return response()->json(['data' => $employer]);
        } else
            return response()->json(['data' => []]);
    }

    public function getApplicationsByEmployer(Request $request, $employerId)
    {
        // Validate the employer_id (you could replace this with any dynamic or auth-based check if needed)
        

        // Get all offers for the given employer_id
        $offers = Offer::where('employer_id', $employerId)->get();

        // Fetch all applications for those offers
        $applications = Application::whereIn('offer_id', $offers->pluck('id'))->get();

        return response()->json([
            'applications' => $applications
        ]);
    }

    // Method to get all applications for a specific offer based on offer_id
    public function getApplicationsByOffer(Request $request, $offerId)
    {
        // Validate that the offer exists
        $offer = Offer::find($offerId);

        if (!$offer) {
            return response()->json(['error' => 'Offer not found'], 404);
        }

        // Fetch all applications for the given offer_id
        $applications = Application::where('offer_id', $offerId)->get();

        return response()->json([
            'applications' => $applications
        ]);
    }
}
