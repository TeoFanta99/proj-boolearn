<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class TeacherTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();

        Teacher::factory()->count(20)->make()->each(function ($teacher) use ($users) { // usiamo la variabile users all'interno del each
            // "scalo" uno ad uno l'array dell'id ottenuto precedentemente
            $user = $users->shift();
            // lo associo tramite la funzione nel model di Teacher all'entità di teacher
            $teacher->user()->associate($user);
            $gender = $user->gender;
            $imageUrl = "https://xsgames.co/randomusers/avatar.php?g={$gender}&random=";
            // Scarica l'immagine dall'URL
            $imageData = file_get_contents($imageUrl);

            // Genera un nome univoco per il file immagine
            $fileName = uniqid() . '.jpg';

            // Salva l'immagine scaricata nella directory di archiviazione pubblica
            Storage::disk('public')->put('images/teacher_avatars/' . $fileName, $imageData);

            // Costruisci l'URL completo per l'immagine salvata
            $imgPath = 'images/teacher_avatars/' . $fileName;

            // Assegna l'URL dell'immagine al campo corrispondente nel modello Teacher
            $teacher->image_url = $imgPath;
            // Salvo
            $teacher->save();
        });
    }
}
