<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Teacher;
use App\Models\User;

class TeacherTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::inRandomOrder()->get();

        Teacher::factory()->count(10)->make()->each(function ($teacher) use ($users) { // usiamo la variabile users all'interno del each
            // "scalo" uno ad uno l'array dell'id ottenuto precedentemente
            $user = $users->shift();
            // lo associo tramite la funzione nel model di Teacher all'entità di teacher
            $teacher->user()->associate($user);
            // Salvo
            $teacher->save();
        });
    }
}
