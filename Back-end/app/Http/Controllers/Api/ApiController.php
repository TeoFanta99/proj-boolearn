<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Review;
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
        
        $parametro = $request->input('nome_cognome');
        $materie = $request->input('subjects');
        
        $subjects= Subject::all();
        $teachers = Teacher::with('user', 'subjects')->get();
        $risultato = [];

        foreach ($teachers as $teacher) {
            $cercaNome = false;
            if (!$parametro || str_starts_with(strtolower($teacher->user->name), strtolower($parametro)) || str_starts_with(strtolower($teacher->user->lastname), strtolower($parametro))) {
                $cercaNome = true;
            }

            $cercaMateria = false;
            if (!$materie || $teacher->subjects->pluck('name')->intersect($materie)->count() === count($materie)) {
                $cercaMateria = true;
            }

            if ($cercaNome && $cercaMateria) {
                $risultato[] = $teacher;
            }
        }

        if (empty ($risultato)) {
            return response()->json(['messaggio' => 'Nessun insegnante trovato', 'teachers' => [],
        'subjects'=>$subjects]);
        } else {
            return response()->json(['messaggio' => 'Insegnanti trovati', 'teachers' => $risultato,'subjects'=>$subjects]);
        }
    }

    public function test(Request $request){

        $id = $request->input('subjects');

        $subjects= Subject::find($id);

        $teachers = $subjects->teacher()->with('user','subjects')->get();

        return response()->json([
                    'status' => 'success',
                    'message' => 'sono andata al front_end',
                    'teachers'=>$teachers,
                ]);

    }

    public function reviews(){

        $review = Review::all();

        return response()->json([
                    'status' => 'success',
                    'message' => 'sono andata al front_end',
                    'reviews '=>$review ,
                ]);

    }

 }
