<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Rating;
use App\Models\Teacher;

class RatingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Rating :: factory() -> count(5) -> create() -> each(function($rating) {
        //     $teacher = Teacher :: inRandomOrder() -> first();
        //     $rating -> teacher() -> attach($teacher);
        //     $rating -> save();
        // }); 

        $valutazioni = [
            1 => "Pessimo",
            2 => "Scarso",
            3 => "Sufficiente",
            4 => "Buono",
            5 => "Ottimo"
        ];

        // Creazione delle valutazioni
        foreach ($valutazioni as $valutazione) {
            // Crea una nuova istanza di Subject e la salva nel database
            $nuova_valut = new Rating();
            $nuova_valut->name = $valutazione;
            $nuova_valut->save();
        }

        // Ottenere tutti i professori
        $teachers = Teacher::inRandomOrder()->get();


        // Associa valutazioni casuali ai professori
        foreach ($teachers as $teacher) {
            // Ottenere valutazioni casuali
            $randomRatings = Rating::inRandomOrder()->take(rand(1, count($valutazioni)))->get();
            foreach ($randomRatings as $randomRating) {
                // Associa la valutazione al professore
                $teacher->ratings()->attach($randomRating->id);
            }
        }
    }
}
