<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Administrator;
use App\Models\Employer;
use App\Models\User;
use App\Models\BlackList;

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

    public function verifyEmployer(Request $request, string $employerId)
    {
        // Walidacja danych
        $data = $request->validate([
            'verified' => 'required|int',
        ]);

        // Znajdź pracodawcę po ID
        $employer = Employer::find($employerId);

        if ($employer) {
            // Ustawienie pola 'verified' na podaną wartość
            $employer->verified = $data['verified'];
            $employer->save();

            return response()->json([
                'message' => 'Employer verification status updated successfully.',
                'data' => $employer
            ], 200);
        }

        return response()->json([
            'message' => 'Employer not found.'
        ], 404);
    }

    public function addToBlackList(Request $request, $userId)
    {
        // Sprawdź, czy użytkownik już nie jest na czarnej liście
        $isAlreadyBlacklisted = BlackList::where('user_id', $userId)->first();

        if ($isAlreadyBlacklisted) {
            return response()->json([
                'message' => 'User is already blacklisted.'
            ], 400);
        }

        // Sprawdzenie, czy użytkownik istnieje
        $user = User::find($userId);
        if (!$user) {
            return response()->json([
                'message' => 'User not found.'
            ], 404);
        }

        // Dodanie użytkownika do czarnej listy
        $blacklist = new BlackList();
        $blacklist->user_id = $userId;
        $blacklist->save();

        return response()->json([
            'message' => 'User added to blacklist successfully.',
            'data' => $blacklist
        ], 201);
    }

    public function removeFromBlackList($userId)
    {
        // Sprawdzenie, czy użytkownik jest na czarnej liście
        $blacklistEntry = BlackList::where('user_id', $userId)->first();

        if ($blacklistEntry) {
            $blacklistEntry->delete();

            return response()->json([
                'message' => 'User removed from blacklist successfully.'
            ], 200);
        }

        return response()->json([
            'message' => 'User not found on the blacklist.'
        ], 404);
    }

}
