<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Review;
use App\Models\Rating;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class ApiController extends Controller
{
   
    public function frontTeachers(Request $request)
    {

        $parametro = $request->input('nome_cognome');
        $materie = $request->input('subjects');

        $subjects = Subject::all();
        $reviews = Review::all();
        $ratings = Rating::all();
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
            return response()->json([
                'messaggio' => 'Nessun insegnante trovato',
                'teachers' => [],
                'subjects' => $subjects
            ]);
        } else {
            return response()->json(['messaggio' => 'Insegnanti trovati', 'teachers' => $risultato, 'subjects' => $subjects, 'reviews' => $reviews, 'ratings' => $ratings]);
        }
    }

    public function test(Request $request)
    {

        $id = $request->input('subject');

        $subjects = Subject::find($id);

        $teachers = $subjects->teacher()->with('user', 'subjects')->get();

        return response()->json([
            'status' => 'success',
            'message' => 'sono andata al front_end',
            'teachers' => $teachers,
        ]);

    }

    public function reviews(Request $request)
    {

        $teacher_id = $request->input('teacher_id');

        // riferimento: slide 72 del 12/02/24, pagina 19
        $reviews = Review::where('teacher_id', $teacher_id)->get();

        return response()->json([
            'status' => 'success',
            'message' => 'sono andata al front_end',
            'reviews' => $reviews,
        ]);

    }

    public function results(Request $request)
    {
        $subject_id = $request->input('subject');
        $rating_id = $request->input('rating');
        $min_number_review = $request->input('review');


        $subjects = Subject::all();
        // Ottieni tutti i teachers con le relazioni pre-caricate
        $teachers = Teacher::with(['user', 'subjects', 'ratings', 'reviews', 'sponsorships'])->get();

        // Array per memorizzare i risultati filtrati
        $filteredTeachers = [];

        foreach ($teachers as $teacher) {
            // Controlla se il teacher ha una sponsorizzazione attiva

            // Ordina le sponsorizzazioni per data di scadenza in modo decrescente e prendi la prima
            if ($teacher->sponsorships->isNotEmpty()) {
                // Ottieni la sponsorizzazione più recente e la sua data di scadenza
                $farthestExpireDate = $teacher->sponsorships()->max('expire_date');
            
                // Controllo se la sponsorizzazione con la data di scadenza più lontana non è scaduta
                if ($farthestExpireDate > Carbon::now()) {
                    $filteredTeachers[] = $teacher;
                }
                if (!empty($filteredTeachers)) {
                    // Ordina gli insegnanti in base alla data di scadenza più lontana delle sponsorizzazioni
                    $filteredTeachers = collect($filteredTeachers)->sortByDesc(function($teacher) {
                        return $teacher->sponsorships()->max('expire_date');
                    });
                
                    // // Ottieni l'insegnante con la data di scadenza più lontana
                    $filteredTeachers = $filteredTeachers->values()->all();

                
                
                }
            }


        }

        // Invia una risposta JSON contenente i teachers con sponsorizzazioni attive
        return response()->json(['teachers'=>$filteredTeachers,'subjects'=>$subjects]);
    }
}
// CODICE CON I FILTRI E SPONSORIZZAZIONI

// // Ottieni tutti i teachers con le relazioni pre-caricate
// $teachers = Teacher::with(['user','subjects', 'ratings', 'reviews'])->get();

// // Array per memorizzare i risultati filtrati
// $filteredTeachers = [];

// foreach ($teachers as $teacher) {
//     // Controlla se il teacher ha tutte le materie specificate, se il parametro subject_id è presente
//     if ($subject_id !== 0) {
//         if (!$teacher->subjects->pluck('id')->contains($subject_id)) {
//             continue;
//         }
//     }

//     $averageRating = $teacher->ratings()->avg('ratings.id');
//     if ($rating_id !== 0) {
//         if ($averageRating < $rating_id) {
//             continue;
//         }
//     }
//     // Filtraggio per numero minimo di recensioni
//     if ($min_number_review !== 0) {
//         if ($teacher->reviews->count() < $min_number_review) {
//             continue;
//         }
//     }
//     if ($teacher->sponsorships->isNotEmpty()) {
//         // Ordino le sponsorizzazioni per data di scadenza in modo decrescente e prendo la prima
//         $expire_date = $teacher->sponsorships->sortByDesc('expire_date')->first()->expire_date;
//         // Controllo se la sponsorizzazione non è scaduta
//         if ($expire_date >=  Carbon::now()) {
//             $filteredTeachers[] = $teacher;
//             continue;
//         }
//     }

//     // Nessun parametro di filtro specificato
//     if ($subject_id === 0 && $rating_id === 0 && $min_number_review === 0) {
//         $filteredTeachers[] = $teacher;
//     }else{
//         // Se il teacher supera tutti i filtri, aggiungilo ai risultati filtrati
//         $filteredTeachers[] = $teacher;

//     }

// }

// // Invia una risposta JSON contenente i teachers filtrati
// return response()->json($filteredTeachers);
// }
// }
