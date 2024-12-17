<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offer;
use App\Models\Employer;
use App\Models\User;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $offers = Offer::with([
            'employer.user',
            'offerType',
            'competences'
        ])
            ->whereDoesntHave('employer.user.blacklist')
            ->get();

        // Return the offers, you can return them as JSON or pass them to a view
        return response()->json($offers);
    }

    public function getOffersByEmployerId($employerId)
    {
        $offers = Offer::with([
            'employer.user',
            'offerType',
            'competences'
        ])->where('employer_id', $employerId)->get();
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

        $offers = Offer::with([
            'employer.user',
            'offerType',
            'competences'
        ])
            ->whereIn('id', $listOfferIds)
            ->get();

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
            'type' => 'required|exists:offer_type,id',
        ]);

        // Create a new offer
        $offer = new Offer();
        $offer->employer_id = $employer->id;
        $offer->title = $data['title'];
        $offer->description = $data['description'];
        $offer->expiration_date = $data['expiration_date'];
        $offer->offer_type_id = $data['type'];
        $offer->save();

        // Return the created offer as JSON
        return response()->json(['data' => $offer]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Fetch the currently authenticated user
        $user = auth()->user();

        // Fetch the offer by ID
        $offer = Offer::with([
            'employer.user',
            'offerType',
            'competences'
        ])->find($id);

        if (!$offer) {
            return response()->json(['error' => 'Offer not found'], 404);
        }

        $hasApplied = false;
        if ($user && $user->role_id === User::ROLE_STUDENT) {
            $studentId = $user->data_id;

            $hasApplied = Application::where('student_id', $studentId)
                ->where('offer_id', $offer->id)
                ->exists();
        }

        return response()->json([
            'offer' => $offer,
            'has_applied' => $hasApplied
        ]);
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
            $offer->offer_type_id = $data['type'];
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

    public function getOfferTypes()
    {
        // Pobierz wszystkie typy ofert
        $offerTypes = \App\Models\OfferType::all();

        // Zwróć wyniki jako JSON
        return response()->json($offerTypes);
    }


    public function getOfferCompetences()
    {
        // Pobierz wszystkie typy ofert
        $offerTypes = \App\Models\Competence::all();

        // Zwróć wyniki jako JSON
        return response()->json($offerTypes);
    }

    public function getOfferIdsByTypeId($typeId)
    {
        // Pobierz oferty bezpośrednio z modelu, filtrując po offer_type_id
        $offers = Offer::where('offer_type_id', $typeId)
            ->with(['competences', 'offerType', 'employer']) // Opcjonalnie dołącz relacje
            ->get();

        return response()->json($offers); // Zwraca dane w formacie JSON
    }


    public function getOfferIdsByFilter(Request $request)
    {
        // Pobierz dane z requestu
        $type = $request->input('type');
        $competences = $request->input('competence');

        // Budujemy zapytanie
        $query = Offer::query();

        // Jeżeli "type" nie jest puste, filtrujemy po offer_type_id
        if ($type) {
            $query->where('offer_type_id', $type);
        }

        // Jeżeli "competence" nie jest puste, filtrujemy po powiązanych kompetencjach
        if ($competences && count($competences) > 0) {
            $query->whereHas('competences', function ($q) use ($competences) {
                $q->whereIn('competence_id', $competences);
            });
        }

        // Wykonaj zapytanie
        $offers = $query->with(['competences', 'offerType', 'employer'])->get();

        // Zwróć oferty w formacie JSON
        return response()->json($offers);
    }

}
