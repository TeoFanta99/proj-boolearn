<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Review;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

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
        $reviews= Review::all();
        $ratings= Rating::all();
        $teachers = Teacher::with('user', 'subjects', 'reviews', 'ratings')->get();
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
            return response()->json(['messaggio' => 'Insegnanti trovati', 'teachers' => $risultato,'subjects'=>$subjects,'reviews'=>$reviews,'ratings'=>$ratings]);
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

    public function reviews(Request $request){

        $teacher_id = $request->input('teacher_id');

        // riferimento: slide 72 del 12/02/24, pagina 19
        $reviews = Review::where('teacher_id', $teacher_id)->get();

        return response()->json([
            'status' => 'success',
            'message' => 'sono andata al front_end',
            'reviews' => $reviews,
        ]);

    }

    public function results(Request $request){

        $subject_id = $request->input('subject');
        $rating_id = $request->input('rating');
        $min_number_review = $request->input('review');

       
        // solo in caso sia stato selezionato la ricerca per numero recensioni
        if(!empty ($min_number_review) && empty ($subject_id) && empty ($rating_id)){

            $subjects= Subject::all();
            $ratings= Rating::all();
            
            //Conta il numero di recensioni per insegnante e mi restituisce gli insegnanti con le materie che possiedono un numero di recensioni maggiore o uguale a quello richiesto sotto forma di array
            $teachers = Teacher::has('reviews', '>=', $min_number_review)->with('user','subjects','ratings')->get();
          
            
        }

         // solo in caso sia stato selezionato la materia
        else if(empty ($min_number_review) && !empty ($subject_id) && empty ($rating_id)){

            $subjects= Subject::find($subject_id);

            $teachers = $subjects->teacher()->with('user','subjects')->get();
            
        }

         // solo in caso sia stato selezionato la votazione
        else if(empty ($min_number_review) && empty ($subject_id) && !empty ($ratings)){

            $subjects= Subject::all();

            $result = [];
           
            foreach ($ratings as $rating) {

                $teacher= Teacher::find($rating)->with('user','subjects')->get();

                $result [] = $teacher;
            }
            
            
        }
    
        // solo in caso sia stato selezionato la materia e la ricerca per numero recensioni
        else if(!empty ($min_number_review) && !empty ($subject_id) && empty ($rating_id)){

                $subjects= Subject::find($subject_id);

                //Conta il numero di recensioni per insegnante e mi restituisce gli insegnanti con le materie che possiedono un numero di recensioni maggiore o uguale a quello richiesto sotto forma di array
                $teachers = Teacher::has('reviews', '>=', $min_number_review)->with('user')->get();
                $teachers = $subjects->teacher()->with('user','subjects')->get();
                
        }

        if (empty ($teachers)) {
            return response()->json(['messaggio' => 'sono tornato con rating', 'teachers' => $result,]);
        }
         else {
            return response()->json([
                'status' => 'success',
                'message' => 'sono andata al front_end',
                'teachers' => $teachers,
            ]);
        }

    }

 }
