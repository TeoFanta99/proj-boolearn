<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Review;
use App\Models\Teacher;

class ReviewTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        // Carica il contenuto del file JSON con le materie
        $jsonReviews = file_get_contents(public_path('reviews.json'));
        $reviewsJSON = json_decode($jsonReviews, true);

        


        for($i = 0; $i < 10; $i++){

            foreach ($reviewsJSON as $reviews) {

                // Creare un array per memorizzare gli insegnanti associati a titoli di recensioni
                $assignedTeachers = [];
                    
                // Ciclo su ciascuna materia della categoria
                foreach ($reviews as $review) {
                     
                    // Cerca un insegnante non associato alla recensione attuale
                    $teacher = Teacher::inRandomOrder()->whereNotIn('id', $assignedTeachers)->first();

                    

                    // Crea una nuova istanza di Subject e la salva nel database
                    $newReview = new Review();
                    $newReview->title = $review['nome'];
                    $newReview->description = $review['descrizione'];
                    $newReview->email = $review['mail'];
                    $newReview->date_of_review = $review['data'];
                

                    $newReview -> teacher() -> associate($teacher);
                    $newReview->save();

                    // Aggiungi l'id dell'insegnante associato all'array
                    $assignedTeachers[] = $teacher->id;
                }
            }

        }
       

        // Review :: factory() -> count(100) -> make() -> each(function($review) {
        //     $teacher = Teacher :: inRandomOrder() -> first();
        //     $review -> teacher() -> associate($teacher);
        //     $review -> save();
        // });
    }
}
