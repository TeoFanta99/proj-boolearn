<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Subject;
use App\Models\Teacher;

class SubjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subjects = Subject::factory()->count(5)->create();

        $teachers = Teacher::inRandomOrder()->get();

        foreach ($teachers as  $teacher) {
            $randomSubjects = $subjects->random(rand(1, $subjects->count()));
            foreach($randomSubjects as $randomSubject){
                $teacher->subjects()->attach($randomSubject->id);
            }
        }
      
    }
}
