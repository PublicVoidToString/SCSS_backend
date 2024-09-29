<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
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
        // Walidacja danych użytkownika
        $data = $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role_id' => 'required|integer', // Rola musi być przekazana
        ]);

        // Tworzenie rekordu użytkownika w tabeli users
        $user = User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role_id' => $data['role_id'],
        ]);

        // Obsługa specyficznych danych dla każdej roli
        switch ($user->role_id) {
            case User::ROLE_STUDENT:
                $studentController = new StudentController();
                $studentResponse = $studentController->store($request, $user->id);
                break;
            
            case User::ROLE_EMPLOYER:
                $employerController = new EmployerController();
                $employerResponse = $employerController->store($request, $user->id);
                break;

            case User::ROLE_CAREEROFFICE:
                $careerOfficeController = new CareerOfficeController();
                $careerOfficeResponse = $careerOfficeController->store($request, $user->id);
                break;
            
            case User::ROLE_ADMINISTRATOR:
                // W przypadku administratora tworzymy rekord bez dodatkowych danych
                break;
        }

        return response()->json(['data' => $user], 201);
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
        $user = User::find($id);
        if($user != null){
            $user->email = $data['email'];
            $user->password = $data['password'];
            $user->data_id = $data['data_id'];
            $user->role_id = $data['role_id'];
            $user->save();
            return response()->json(['data'=>[]]);
        }
        return response()->json(['data'=>[]]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        if($user != null){
            $user->delete();
            return response()->json(['data'=>$user]);
        }else
        return response()->json(['data'=>[]]);
    }
}
