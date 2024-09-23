<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserAuthController extends Controller
{
    public function register(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|unique:user,email',
            'password' => 'required|min:6',
        ]);

        $user = new User();
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role_id = $request->role_id;
        $user->data_id = $request->data_id;

        $user->save();

        $token = JWTAuth::fromUser($user);

        return response()->json(['token' => $token]);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'haslo');

        if (!$token = Auth::guard('user')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json(['token' => $token]);
    }

    public function me()
    {
        return response()->json(Auth::guard('user')->user());
    }
}
