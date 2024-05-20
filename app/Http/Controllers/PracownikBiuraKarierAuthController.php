<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PracownikBiuraKarier;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class PracownikBiuraKarierAuthController extends Controller
{
    public function register(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|unique:pracownikbiurakarier,email',
            'haslo' => 'required|min:6',
        ]);

        $pracownikbiurakarier = new PracownikBiuraKarier();
        $pracownikbiurakarier->email = $request->email;
        $pracownikbiurakarier->haslo = Hash::make($request->haslo);
        $pracownikbiurakarier->save();

        $token = JWTAuth::fromUser($pracownikbiurakarier);

        return response()->json(['token' => $token]);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'haslo');

        if (!$token = Auth::guard('pracownikbiurakarier')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json(['token' => $token]);
    }

    public function me()
    {
        return response()->json(Auth::guard('pracownikbiurakarier')->user());
    }
}
