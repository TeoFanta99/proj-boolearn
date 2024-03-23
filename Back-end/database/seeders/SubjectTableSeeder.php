<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Subject;
use App\Models\Teacher;

class SubjectTableSeeder extends Seeder
{
    public function run()
    {
        // Carica il contenuto del file JSON con le materie
        $jsonSubjects = file_get_contents(public_path('subject.json'));
        $subjectsJSON = json_decode($jsonSubjects, true);
        foreach ($subjectsJSON as $subjects) {
            // Ciclo su ciascuna materia della categoria
            foreach ($subjects as $subject) {
                // Crea una nuova istanza di Subject e la salva nel database
                $newSubject = new Subject();
                $newSubject->name = $subject['nome'];
                $newSubject->description = $subject['descrizione'];
                $newSubject->save();
            }
        }
        // Ottieni tutti gli insegnanti in modo casuale
        $teachers = Teacher::inRandomOrder()->get();




        // Ciclo sugli insegnanti
        foreach ($teachers as $teacher) {
            $randCatSubject = rand(1, 3);

            // Seleziona le materie in base alla categoria scelta casualmente
            switch ($randCatSubject) {
                case 1:
                    $selectedSubjects = $subjectsJSON['backEndSubjects'];
                    break;
                case 2:
                    $selectedSubjects = $subjectsJSON['frontEndSubjects'];
                    break;
                case 3:
                    $selectedSubjects = $subjectsJSON['databaseSubjects'];
                    break;
                default:
                    $selectedSubjects = [];
                    break;
            }
            // Scegli un numero casuale di materie da collegare
            $numRandomSubjects = rand(2, count($selectedSubjects));

            // Seleziona casualmente le materie da collegare
            $randomIndexes = (array) array_rand($selectedSubjects, $numRandomSubjects);

            // Ciclo sui soggetti casuali
            foreach ($randomIndexes as $index) {
                $randomSubject = $selectedSubjects[$index];

                // Cerca la materia nel database
                $subject = Subject::where('name', $randomSubject['nome'])->first();

                // Collega il soggetto all'insegnante solo se esiste nel database
                if ($subject) {
                    $teacher->subjects()->attach($subject->id);
                }
            }
        }
    }
}
