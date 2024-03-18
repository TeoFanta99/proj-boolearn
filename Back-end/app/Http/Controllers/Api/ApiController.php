<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getEvent()
    {

        return response()->json([

            'status' => 'success',
            'message' => 'Testo di prova',
        ]);
    }
    // public function getTeachers()
    // {
    //     $subjects= Subject::all();
    //     $teachers = Teacher::with( 'user')->get();



    //     return response()->json([
    //         'status' => 'success',
    //         'teachers' => $teachers,
    //         'subjects'=>$subjects

    //     ]);
    // }

    public function frontTeachers(Request $request)
    {
        $risultato = [];
        $parametro = $request->input('nome_cognome');

        $teachers = Teacher::with('user', 'subjects')->get();

        
        if ($parametro === null) {
            
            $risultato = $teachers;
        } else {
           
            foreach ($teachers as $teacher) {
                
                if (
                    str_starts_with(strtolower($teacher->user->name), strtolower($parametro)) ||
                    str_starts_with(strtolower($teacher->user->lastname), strtolower($parametro))
                ) {
                    
                    $risultato[] = $teacher;
                }
            }
        }

        // Verifica se ci sono insegnanti trovati
        if (empty ($risultato)) {
            return response()->json(['messaggio' => 'Nessun insegnante trovato', 'teachers' => []]);
        } else {
            return response()->json(['messaggio' => 'Insegnanti trovati', 'teachers' => $risultato
            
        ]);
        }
    }

    // public function getSubjects()
    // {

    //     $teachers = Teacher::with('user')->get();

    //     return response()->json([
    //         'status' => 'success',
    //         'teachers' => $teachers,

    //     ]);
    // }
}
