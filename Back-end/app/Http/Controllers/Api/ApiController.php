<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Message;
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

    // Ottiene messaggio dal form (contactTeacherForm.vue)
    public function getMessage(Request $request)
    {

        $user_name = $request->input('user_name');
        $user_email = $request->input('user_email');
        $email_title = $request->input('email_title');
        $description = $request->input('description');
        $teacher_id = $request->input('teacher_id');
        // dd($user_name, $user_email, $email_title, $description, $teacher_id);

        $teacher = Teacher::find($teacher_id);

        $new_message = new Message();
        $new_message->user_name = $user_name;
        $new_message->user_email = $user_email;
        $new_message->email_title = $email_title;
        $new_message->description = $description;
        $new_message->date_of_message = Carbon::now();
        $new_message->teacher()->associate($teacher);
        $new_message->save();



    }

    // Ottiene recensione dal form (reviewForm.vue)
    public function getReview(Request $request)
    {

        $title = $request->input('title');
        $user_email = $request->input('user_email');
        $description = $request->input('description');
        $teacher_id = $request->input('teacher_id');

        $teacher = Teacher::find($teacher_id);

        $new_review = new Review();
        $new_review->title = $title;
        $new_review->email = $user_email;
        $new_review->description = $description;
        $new_review->date_of_review = Carbon::now();
        $new_review->teacher()->associate($teacher);
        $new_review->save();

    }

    // Ottiene rating dal form (ratingForm.vue)
    public function getRating(Request $request)
    {

        $rating_id = $request->input('idRating');
        $teacher_id = $request->input('teacher_id');

        $teacher = Teacher::find($teacher_id);
        $rating = Rating::find($rating_id);


        $teacher->ratings()->attach($rating);

        $teacher->save();

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
        $subjects = Subject::all();
        $ratings = Rating::all();

        // Ottieni tutti i teachers con le relazioni pre-caricate
        $teachers = Teacher::with(['user', 'subjects', 'ratings', 'reviews', 'sponsorships'])->get();

        // Array per memorizzare i risultati filtrati
        $filteredTeachers = [];

        // Calcola la media dei voti e filtra gli insegnanti con sponsorizzazioni attive
        foreach ($teachers as $teacher) {
            // Calcola la media dei voti
            $averageRating = $teacher->ratings()->avg('rating_id');

            // Aggiungi la media dei voti all'insegnante
            $teacher->average_rating = $averageRating;

            // Controlla se il teacher ha una sponsorizzazione attiva
            if ($teacher->sponsorships->isNotEmpty()) {
                // Ottieni la sponsorizzazione più recente e la sua data di scadenza
                $farthestExpireDate = $teacher->sponsorships()->max('expire_date');

                // Controllo se la sponsorizzazione con la data di scadenza più lontana non è scaduta
                if ($farthestExpireDate > Carbon::now()) {
                    $filteredTeachers[] = $teacher;
                }
            }
        }

        // Ordina gli insegnanti in base alla data di scadenza più lontana delle sponsorizzazioni
        if (!empty ($filteredTeachers)) {
            $filteredTeachers = collect($filteredTeachers)->sortByDesc(function ($teacher) {
                return $teacher->sponsorships()->max('expire_date');
            })->values()->all();
        }

        // Invia una risposta JSON contenente i teachers con sponsorizzazioni attive
        return response()->json(['teachers' => $filteredTeachers, 'subjects' => $subjects, 'ratings' => $ratings]);
    }
    public function filtered(Request $request)
    {
        $subject = $request->input('subject');
        $rating_id = $request->input('rating');
        $min_number_review = $request->input('review');
        if ($subject == 'Tutte') {
            $subject_id = 0;
        } else {

            $subject_ = Subject::whereRaw('LOWER(name) = ?', [strtolower($subject)])->first();
            $subject_id = $subject_->id;
        }

        // Ottieni tutti i teachers con le relazioni pre-caricate
        $teachers = Teacher::with(['user', 'subjects', 'ratings', 'reviews', 'sponsorships'])->get();

        // Array per memorizzare i risultati filtrati
        $filteredTeachers = [];
        $sponsoredTeachers = [];

        foreach ($teachers as $teacher) {

            // Controlla se il teacher ha tutte le materie specificate, se il parametro subject_id è presente
            if ($subject_id !== 0) {
                if (!$teacher->subjects->pluck('id')->contains($subject_id)) {
                    continue;
                }
            }

            $averageRating = $teacher->ratings()->avg('rating_id');

            
            $teacher->average_rating =intval(round($averageRating));

            
            if ($rating_id !== 0) {
                if (round($averageRating) < $rating_id) {
                    continue;
                }
            }
            // Filtraggio per numero minimo di recensioni
            if ($min_number_review !== 0) {
                if ($teacher->reviews->count() < $min_number_review) {
                    continue;
                }
            }
            if ($teacher->sponsorships->isNotEmpty()) {
                // Ottieni la sponsorizzazione più recente e la sua data di scadenza
                $farthestExpireDate = $teacher->sponsorships()->max('expire_date');

                // Controllo se la sponsorizzazione con la data di scadenza più lontana non è scaduta
                if ($farthestExpireDate > Carbon::now()) {
                    $sponsoredTeachers[] = $teacher;
                }
                if (!empty ($sponsoredTeachers)) {
                    // Ordina gli insegnanti in base alla data di scadenza più lontana delle sponsorizzazioni
                    $sponsoredTeachers = collect($sponsoredTeachers)->sortByDesc(function ($teacher) {
                        return $teacher->sponsorships()->max('expire_date');
                    });

                    // // Ottieni l'insegnante con la data di scadenza più lontana
                    $sponsoredTeachers = $sponsoredTeachers->values()->all();



                }
            }



            // Se il teacher non è sponsorizzato o la sponsorizzazione è scaduta
            $filteredTeachers[] = $teacher;
        }
        $filteredTeachers = collect($filteredTeachers)->diff($sponsoredTeachers)->values()->all();

        // Riunisci i teacher sponsorizzati all'inizio dell'array restituito
        $filteredTeachers = array_merge($sponsoredTeachers, $filteredTeachers);

        // dd($sponsoredTeachers);
        // Invia una risposta JSON contenente i teachers filtrati
        return response()->json($filteredTeachers);

    }
}




