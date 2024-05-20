<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pracodawca;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class PracodawcaAuthController extends Controller
{
    public function register(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|unique:pracodawca,email',
            'haslo' => 'required|min:6',
        ]);

        $pracodawca = new Pracodawca();
        $pracodawca->email = $request->email;
        $pracodawca->haslo = Hash::make($request->haslo);
        $pracodawca->nazwa_firmy = $request->nazwa_firmy;
        $pracodawca->save();

        $token = JWTAuth::fromUser($pracodawca);

        return response()->json(['token' => $token]);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'haslo');

        if (!$token = Auth::guard('pracodawca')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json(['token' => $token]);
    }

    public function me()
    {
        return response()->json(Auth::guard('pracodawca')->user());
    }
}
