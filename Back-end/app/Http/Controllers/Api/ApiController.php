<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Review;
use App\Models\Rating;
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

       
        // REVIEW = YES  ||||| RATING + SUBJECT = NO
        if(!empty ($min_number_review) && empty ($subject_id) && empty ($rating_id)){

            $subjects= Subject::all();
            $ratings= Rating::all();
            
            //Conta il numero di recensioni per insegnante e mi restituisce gli insegnanti con le materie che possiedono un numero di recensioni maggiore o uguale a quello richiesto sotto forma di array
            $teachers = Teacher::has('reviews', '>=', $min_number_review)->with('user','subjects','ratings')->get();
          
        }


         // SUBJECT = YES  ||||| RATING + REVIEWS = NO
        else if(empty ($min_number_review) && !empty ($subject_id) && empty ($rating_id)){

            $subjects= Subject::find($subject_id);

            $teachers = $subjects->teacher()->with('user','subjects')->get();
            
        }

    
        // SUBJECT + REVIEW = YES  ||||| RATING = NO
        else if(!empty ($min_number_review) && !empty ($subject_id) && empty ($rating_id)){

            $subjects= Subject::find($subject_id);

            //Conta il numero di recensioni per insegnante e mi restituisce gli insegnanti con le materie che possiedono un numero di recensioni maggiore o uguale a quello richiesto sotto forma di array
            $teachers = Teacher::has('reviews', '>=', $min_number_review)->with('user')->get();
            $teachers = $subjects->teacher()->with('user','subjects')->get();
            
        }

        // solo in caso sia stato selezionato la ricerca per numero recensioni
        // if(!empty ($subject_id )){
        //     //Conta il numero di recensioni per insegnante e mi restituisce gli insegnanti con le materie che possiedono un numero di recensioni maggiore o uguale a quello richiesto sotto forma di array
        //     $teachersWithReviews = Teacher::has('reviews', '>=', $min_number_review)->with('subjects')->get();
        // }
    
        

        //$teachers = $subjects->teacher()->with('user','subjects','prova')->get();

        //$reviews = Review::where('teacher_id', $review_id)->get();

        //$teachers = Teacher::with('user', 'subjects', 'risultato', 'ratings')->get();

        
        return response()->json([
            'status' => 'success',
            'message' => 'sono andata al front_end',
            'teachers' => $teachers,
        ]);

    }

 }
