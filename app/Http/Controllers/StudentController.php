<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Application;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\QuizResult;

class StudentController extends Controller
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
    public function store(Request $request, $userId)
    {
        // Walidacja danych studenta
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'indexnumber' => 'required|string|max:20',
            'description' => 'nullable|string',
            'photourl' => 'nullable|string|max:255',
        ]);

        // Tworzenie rekordu studenta
        $student = Student::create($data);

        // Przypisanie data_id w tabeli users do id studenta
        $user = User::find($userId);
        $user->data_id = $student->id;
        $user->save();

        return response()->json(['data' => $student], 201);
    }

    public function getApplicationsByStudentFiltered(Request $request)
    {
    $user = auth()->user();

    $student = Student::find($user->data_id);

    if (!$student) {
        return response()->json(['error' => 'Student not found'], 404);
    }

    $query = Application::where('student_id', $student->id)
                        ->with(['offer', 'student']); 
                        
    if ($request->has('status') && $request->status !== 'all') {
        $query->where('status', $request->status);
    }

    $applications = $query->get();

    return response()->json([
        'applications' => $applications
    ]);
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
    public function update(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'indexnumber' => 'nullable|string|max:50',
            'description' => 'nullable|string|max:255',
        ]);

        $user = Auth::guard('user')->user();
        $studentId = $user->data_id;
    
        $student = Student::find($studentId);
    
        if ($student == null) {
            return response()->json(['error' => 'Student not found'], 404);
        }

        $student->update([
            Student::FIELD_NAME => $data['name'],
            Student::FIELD_SURNAME => $data['surname'],
            Student::FIELD_INDEX_NUMBER => $data['indexnumber'],
            Student::FIELD_DESCRIPTION => $data['description'],
        ]);
    
        return response()->json(['data' => $student]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $student = Student::find($id);
        if($student != null){
            $student->delete();
            return response()->json(['data'=>$student]);
        }else
        return response()->json(['data'=>[]]);
    }
}
