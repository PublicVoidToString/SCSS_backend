<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class StudentAuthController extends Controller
{
    public function register(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|unique:student,email',
            'haslo' => 'required|min:6',
        ]);

        $student = new Student();
        $student->email = $request->email;
        $student->haslo = Hash::make($request->haslo);
        $student->save();

        $token = JWTAuth::fromUser($student);

        return response()->json(['token' => $token]);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'haslo');

        if (!$token = Auth::guard('student')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json(['token' => $token]);
    }

    public function me()
    {
        return response()->json(Auth::guard('student')->user());
    }
}