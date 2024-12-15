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
            $employer->companyname = $data['companyname'];
            $employer->krsnumber = $data['krsnumber'];
            $employer->save();
            return response()->json(['data'=>[]]);
        }
        return response()->json(['data'=>[]]);
    }
        */
    public function update(Request $request)
    {
        // Pobierz zalogowanego użytkownika
        $user = Auth::guard('api')->user();

       
        $employerId = $user->data_id;
    
        $employer = Employer::find($employerId);
    
        if ($employer == null) {
            return response()->json(['error' => 'Employer not found'], 404);
        }
        // Znajdź pracodawcę na podstawie data_id w tabeli users, które wskazuje na id w tabeli employers
        $employer = Employer::where('id', $employerId)->where('id', $user->data_id)->first();

        // Sprawdź, czy znaleziono pracodawcę
        if (!$employer) {
            return response()->json(['error' => 'Unauthorized or employer not found'], 403);
        }

        // Walidacja danych
        $validatedData = $request->validate([
            'description' => 'required|string|max:255',
        ]);

        // Aktualizacja danych pracodawcy
        $employer->description = $validatedData['description'];
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

    public function acceptApplication(Request $request, $applicationId)
    {
        // Fetch the application by ID
        $application = Application::find($applicationId);

        // Check if the application exists
        if (!$application) {
            return response()->json(['error' => 'Application not found'], 404);
        }

        // Update the application status to accepted
        $application->status = 'accepeted';
        $application->save();

        return response()->json(['message' => 'Application accepted successfully']);
    }

    public function rejectApplication(Request $request, $applicationId)
    {
        // Fetch the application by ID
        $application = Application::find($applicationId);

        // Check if the application exists
        if (!$application) {
            return response()->json(['error' => 'Application not found'], 404);
        }

        // Update the application status to rejected
        $application->status = 'rejected';
        $application->save();

        return response()->json(['message' => 'Application rejected successfully']);
    }

    public function getApplicationsByOffer(Request $request, $offerId)
{
    // First, check if the offer exists for the given employer
    $offer = Offer::where('id', $offerId)
                  ->first();

    if (!$offer) {
        return response()->json(['error' => 'offer does not exist'], 404);
    }

    // Fetch all applications for the given offer_id
    $applications = Application::where('offer_id', $offerId)
                               ->with('student') // Eager load the student relationship
                               ->get();

    return response()->json([
        'applications' => $applications
    ]);
}
}
