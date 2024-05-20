<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Administrator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AdministratorAuthController extends Controller
{
    public function register(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|unique:administrator,email',
            'haslo' => 'required|min:6',
        ]);

        $administrator = new Administrator();
        $administrator->email = $request->email;
        $administrator->haslo = Hash::make($request->haslo);
        $administrator->imie = $request->imie;
        $administrator->nazwisko = $request->nazwisko;
        $administrator->save();

        $token = JWTAuth::fromUser($administrator);

        return response()->json(['token' => $token]);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'haslo');

        if (!$token = Auth::guard('administrator')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json(['token' => $token]);
    }

    public function me()
    {
        return response()->json(Auth::guard('administrator')->user());
    }
}
