<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\BlackList;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Log;

class UserAuthController extends Controller
{
    public function register(Request $request)
    {
        // exception handling is managed by Handler.php
        $this->validateRegistrationRequest($request);

        $roleId = $request->role_id;

        $dataId = null;
        switch ($roleId) {
            case User::ROLE_STUDENT:
                $student = \App\Models\Student::create([]);
                $dataId = $student->id;
                break;

            case User::ROLE_EMPLOYER:
                $employer = \App\Models\Employer::create([]);
                $dataId = $employer->id;
                break;

            default:
                return response()->json(['error' => 'Invalid role'], 400);
        }

        return $this->createUser($request, $dataId);
    }

    public function registerPriviligedUser(Request $request)
    {

        // exception handling is managed by Handler.php
        $this->validateRegistrationRequest($request);

        $roleId = $request->role_id;

        $dataId = null;
        switch ($roleId) {
            case User::ROLE_ADMINISTRATOR:
                $administrator = \App\Models\Administrator::create([]);
                $dataId = $administrator->id;
                break;

            case User::ROLE_CAREEROFFICE:
                $this->validate($request, [
                    'university' => 'required|string|max:255',
                ]);

                $careerOffice = \App\Models\CareerOffice::create([
                    'university' => $request->university,
                ]);
                $dataId = $careerOffice->id;
                break;

            default:
                return response()->json(['error' => 'Invalid role'], 400);
        }

        return $this->createUser($request, $dataId);
    }

    private function validateRegistrationRequest(Request $request)
    {

        $this->validate($request, [
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role_id' => 'required|integer',
        ]);
    }

    private function createUser(Request $request, $dataId)
    {
        $user = new User();
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role_id = $request->role_id;
        $user->data_id = $dataId;

        log::info('User before save', $user->toArray());

        $user->save();

        // Generate JWT token
        $token = JWTAuth::fromUser($user);

        return response()->json([
            'token' => $token,
            'user' => $user,
        ]);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Sprawdzenie, czy użytkownik jest na czarnej liście
        $user = User::where('email', $credentials['email'])->first();
        if ($user && BlackList::where('user_id', $user->id)->exists()) {
            return response()->json(['error' => 'User is blacklisted'], 403);
        }

        if (!$token = Auth::guard('user')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json(['token' => $token, 'role' => $user->role_id,]);
    }

    public function me()
    {
        $user = Auth::guard('user')->user();

        // Load the associated 'data' based on the role_id
        $data = $user->data ? $user->data->first() : null;


        return response()->json([
            'user' => $user,
        ]);
    }
}
