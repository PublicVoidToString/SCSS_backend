<?php

namespace App\Http\Controllers;

use App\Models\QuizResult;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class QuizResultController extends Controller
{
      // Tablica punktów przypisanych do odpowiedzi dla każdego pytania
      private $questions_points = [
        // Pytanie 1
        0 => [
            'A' => ['Frontend' => 3],
            'B' => ['Backend' => 3],
            'C' => ['Analityk' => 3],
            'D' => ['SysAdmin' => 3],
            'E' => ['Cybersecurity' => 3],
        ],
        // Pytanie 2
        1 => [
            'A' => ['Frontend' => 3],
            'B' => ['Backend' => 3],
            'C' => ['Analityk' => 3],
            'D' => ['SysAdmin' => 3],
            'E' => ['Cybersecurity' => 3],
        ],
        // Pytanie 3
        2 => [
            'A' => ['Frontend' => 3],
            'B' => ['Backend' => 3],
            'C' => ['Analityk' => 3],
            'D' => ['SysAdmin' => 3],
            'E' => ['Cybersecurity' => 3],
        ],
        // Pytanie 4
        3 => [
            'A' => ['Frontend' => 3],
            'B' => ['Backend' => 3],
            'C' => ['Analityk' => 3],
            'D' => ['SysAdmin' => 3],
            'E' => ['Cybersecurity' => 3],
        ],
        // Pytanie 5
        4 => [
            'A' => ['Frontend' => 3],
            'B' => ['Backend' => 3],
            'C' => ['Analityk' => 3],
            'D' => ['SysAdmin' => 3],
            'E' => ['Cybersecurity' => 3],
        ],
        // Pytanie 6
        5 => [
            'A' => ['Frontend' => 3],
            'B' => ['Backend' => 3],
            'C' => ['Analityk' => 3],
            'D' => ['SysAdmin' => 3],
            'E' => ['Cybersecurity' => 3],
        ],
        // Pytanie 7
        6 => [
            'A' => ['Frontend' => 3],
            'B' => ['Backend' => 3],
            'C' => ['Analityk' => 3],
            'D' => ['SysAdmin' => 3],
            'E' => ['Cybersecurity' => 3],
        ],
        // Pytanie 8
        7 => [
            'A' => ['Frontend' => 3],
            'B' => ['Backend' => 3],
            'C' => ['Analityk' => 3],
            'D' => ['SysAdmin' => 3],
            'E' => ['Cybersecurity' => 3],
        ],
        // Pytanie 9
        8 => [
            'A' => ['Frontend' => 3],
            'B' => ['Backend' => 3],
            'C' => ['Analityk' => 3],
            'D' => ['SysAdmin' => 3],
            'E' => ['Cybersecurity' => 3],
        ],
        // Pytanie 10
        9 => [
            'A' => ['Frontend' => 3],
            'B' => ['Backend' => 3],
            'C' => ['Analityk' => 3],
            'D' => ['SysAdmin' => 3],
            'E' => ['Cybersecurity' => 3],
        ],
        // Pytanie 11 (Prawda/False)
        10 => [
            'Prawda' => ['Frontend' => 3, 'Backend' => 1],
            'False' => [],
        ],
        // Pytanie 12 (Prawda/False)
        11 => [
            'Prawda' => ['Analityk' => 3],
            'False' => [],
        ],
        // Pytanie 13 (Prawda/False)
        12 => [
            'Prawda' => ['Cybersecurity' => 3],
            'False' => [],
        ],
        // Pytanie 14 (Prawda/False)
        13 => [
            'Prawda' => ['Frontend' => 3],
            'False' => [],
        ],
        // Pytanie 15 (Prawda/False)
        14 => [
            'Prawda' => ['Backend' => 3, 'Analityk' => 2],
            'False' => [],
        ],
        // Pytanie 16 (Prawda/False)
        15 => [
            'Prawda' => ['SysAdmin' => 3],
            'False' => [],
        ],
        // Pytanie 17 (Prawda/False)
        16 => [
            'Prawda' => ['Cybersecurity' => 3],
            'False' => [],
        ],
        // Pytanie 18 (Prawda/False)
        17 => [
            'Prawda' => ['Backend' => 3, 'SysAdmin' => 2],
            'False' => [],
        ],
        // Pytanie 19 (Prawda/False)
        18 => [
            'Prawda' => ['Frontend' => 3],
            'False' => [],
        ],
        // Pytanie 20 (Prawda/False)
        19 => [
            'Prawda' => ['SysAdmin' => 3, 'Backend' => 2],
            'False' => [],
        ],
        // Pytanie 21 (Prawda/False)
        20 => [
            'Prawda' => ['Analityk' => 3],
            'False' => [],
        ],
        // Pytanie 22 (Prawda/False)
        21 => [
            'Prawda' => ['Analityk' => 3, 'Frontend' => 2],
            'False' => [],
        ],
        // Pytanie 23 (Prawda/False)
        22 => [
            'Prawda' => ['Cybersecurity' => 3],
            'False' => [],
        ],
        // Pytanie 24 (Prawda/False)
        23 => [
            'Prawda' => ['Backend' => 3, 'SysAdmin' => 2],
            'False' => [],
        ],
        // Pytanie 25 (Prawda/False)
        24 => [
            'Prawda' => ['Backend' => 3],
            'False' => [],
        ],
        // Pytanie 26 (Prawda/False)
        25 => [
            'Prawda' => ['SysAdmin' => 3, 'Cybersecurity' => 2],
            'False' => [],
        ],
        // Pytanie 27 (Prawda/False)
        26 => [
            'Prawda' => ['Frontend' => 3],
            'False' => [],
        ],
        // Pytanie 28 (Prawda/False)
        27 => [
            'Prawda' => ['SysAdmin' => 3, 'Backend' => 2],
            'False' => [],
        ],
        // Pytanie 29 (Prawda/False)
        28 => [
            'Prawda' => ['Cybersecurity' => 3],
            'False' => [],
        ],
        // Pytanie 30 (Prawda/False)
        29 => [
            'Prawda' => ['Frontend' => 3, 'Backend' => 2],
            'False' => [],
        ],
    ];

     // Funkcja obliczająca punkty na podstawie odpowiedzi
     private function calculatePoints($answers)
     {
         $points = [
             'Frontend' => 0,
             'Backend' => 0,
             'Analityk' => 0,
             'SysAdmin' => 0,
             'Cybersecurity' => 0,
         ];
 
         // Iterujemy po odpowiedziach
         foreach ($answers as $index => $answer) {
             if (isset($this->questions_points[$index][$answer])) {
                 $points_for_answer = $this->questions_points[$index][$answer]; // Pobieramy punkty dla odpowiedzi
 
                 // Dodajemy punkty do odpowiednich specjalności
                 foreach ($points_for_answer as $specialty => $point) {
                     $points[$specialty] += $point;
                 }
             }
         }
 
         // Zwracamy sumę punktów dla każdej specjalności
         return $points;
     }

     // Funkcja wyświetlająca dominującą ścieżkę kariery
    private function getCareerPath($points)
    {
        arsort($points); // Sortujemy punkty w malejącej kolejności
        $dominant_path = key($points); // Pobieramy specjalność z najwyższą liczbą punktów
        return $dominant_path;
    }
    // Metoda GET do pobrania wyników dla konkretnego studenta na podstawie jego ID
public function getCareerPathResultsForStudent($student_id)
{

    // Pobieramy zalogowanego użytkownika
    $user = Auth::guard('api')->user();

    // Sprawdzamy, czy student_id w żądaniu jest zgodne z ID zalogowanego użytkownika
    if ($user->data_id != $student_id) {
        return response()->json([
            'message' => 'Nie masz uprawnień do wyświetlania wyników tego studenta.',
        ], 403);
    }
    // Sprawdzamy, czy student istnieje w bazie danych
    $student = Student::find($student_id);

    if (!$student) {
        return response()->json([
            'message' => 'Student o podanym ID nie istnieje.',
        ], 404);
    }

    // Pobieramy wynik quizu dla tego studenta
    $quizResult = QuizResult::where('student_id', $student_id)->first();

    if (!$quizResult) {
        return response()->json([
            'message' => 'Nie znaleziono wyników quizu dla tego studenta.',
        ], 404);
    }

    // Dekodujemy odpowiedzi (jeśli są przechowywane w formacie JSON)
    $answers = json_decode($quizResult->questions_data, true);

    // Obliczamy punkty na podstawie odpowiedzi
    $points = $this->calculatePoints($answers);

    // Zwracamy wynik w formie JSON
    return response()->json([
        'message' => 'Wyniki dla studenta',
        'data' => [
            'student_id' => $student_id,
            'points' => $points, // Punkty dla każdego stanowiska
            'dominant_path' => $this->getCareerPath($points), // Dominująca ścieżka kariery
        ],
    ]);
}
    // Metoda POST do zapisania wyników quizu
    public function storeQuizResults(Request $request)
{
    // Walidacja danych wejściowych
    $request->validate([
        'student_id' => 'required|exists:student,id', // Zmieniamy na 'students' zamiast 'student'
        'answers' => 'required|array', // Odpowiedzi muszą być tablicą
        'answers.*' => 'in:A,B,C,D,E,Prawda,False', // Odpowiedzi muszą być jedną z dozwolonych
    ]);

    // Pobieramy zalogowanego użytkownika
    $user = Auth::guard('api')->user();

    // Pobieramy student_id z requestu
    $student_id = $request->input('student_id');

    // Znajdź studenta na podstawie student_id i sprawdź, czy jest związany z zalogowanym użytkownikiem
    $student = Student::where('id', $student_id)->where('id', $user->data_id)->first();

    // Sprawdź, czy znaleziono studenta
    if (!$student) {
        return response()->json(['error' => 'Unauthorized or student not found'], 403);
    }

      // Sprawdzamy, czy odpowiedzi na pytania 1-10 są jedynie A, B, C, D, E
      foreach ($request->input('answers') as $index => $answer) {
        // Dla pytań 0-9 (pierwsze 10 pytań)
        if ($index < 10 && !in_array($answer, ['A', 'B', 'C', 'D', 'E'])) {
            return response()->json([
                'message' => "Nieprawidłowa odpowiedź na pytanie " . ($index + 1) . ". Odpowiedzi na pytania 1-10 muszą być jedną z wartości: A, B, C, D, E.",
            ], 400);
        }

    // Sprawdzamy, czy odpowiedzi typu "Prawda/False" nie mają odpowiedzi A, B, C, D, E
    foreach ($request->input('answers') as $index => $answer) {
        if (in_array($answer, ['A', 'B', 'C', 'D', 'E']) && isset($this->questions_points[$index]) && isset($this->questions_points[$index]['Prawda'])) {
            // Jeśli odpowiedź A, B, C, D, E jest przypisana do pytania "Prawda/False", to zwrócimy błąd
            return response()->json([
                'message' => "Nieprawidłowa odpowiedź na pytanie $index. Odpowiedzi na pytania 'Prawda/False' muszą być 'Prawda' lub 'False'.",
            ], 400);
        }

        // Jeśli odpowiedź "Prawda" lub "False" jest przypisana do pytania, to nie możemy mieć innych odpowiedzi
        if (isset($this->questions_points[$index]['Prawda']) && !in_array($answer, ['Prawda', 'False'])) {
            return response()->json([
                'message' => "Nieprawidłowa odpowiedź na pytanie $index. Odpowiedź powinna być 'Prawda' lub 'False'.",
            ], 400);
        }
    }

    // Pobieramy odpowiedzi z requestu
    $answers = $request->input('answers');

    // Obliczamy punkty na podstawie odpowiedzi
    $points = $this->calculatePoints($answers);

    // Sprawdzamy, czy wynik quizu już istnieje
    $existingQuizResult = QuizResult::where('student_id', $student_id)->first();

    if ($existingQuizResult) {
        // Jeśli wynik quizu istnieje, nadpisujemy go
        $existingQuizResult->update([
            'frontend_points' => $points['Frontend'],
            'backend_points' => $points['Backend'],
            'devops_points' => $points['SysAdmin'], // Zakładając, że DevOps to SysAdmin
            'data_science_points' => $points['Analityk'], // Zakładając, że Analityk to Data Science
            'cybersecurity_points' => $points['Cybersecurity'],
            'questions_data' => json_encode($answers), // Przechowujemy odpowiedzi w formacie JSON
        ]);

        // Zwracamy odpowiedź z wynikiem quizu
        return response()->json([
            'message' => 'Wyniki quizu zostały zaktualizowane.',
            'data' => [
                'student_id' => $student_id,
                'points' => $points, // Zwracamy punkty dla każdego stanowiska
                'dominant_path' => $this->getCareerPath($points), // Dominująca ścieżka kariery
            ],
        ]);
    } else {
        // Jeśli wynik quizu nie istnieje, tworzymy nowy rekord
        $quizResult = QuizResult::create([
            'student_id' => $student_id,
            'frontend_points' => $points['Frontend'],
            'backend_points' => $points['Backend'],
            'devops_points' => $points['SysAdmin'], // Zakładając, że DevOps to SysAdmin
            'data_science_points' => $points['Analityk'], // Zakładając, że Analityk to Data Science
            'cybersecurity_points' => $points['Cybersecurity'],
            'questions_data' => json_encode($answers), // Przechowujemy odpowiedzi w formacie JSON
        ]);

        // Zwracamy odpowiedź z wynikiem quizu
        return response()->json([
            'message' => 'Wyniki quizu zostały zapisane pomyślnie.',
            'data' => [
                'student_id' => $student_id,
                'points' => $points, // Zwracamy punkty dla każdego stanowiska
                'dominant_path' => $this->getCareerPath($points), // Dominująca ścieżka kariery
            ],
        ]);
    }
}

    


}
}
