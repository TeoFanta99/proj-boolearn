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
        Subject :: factory() -> count(5) -> create() -> each(function($subject) {
            $teacher = Teacher::inRandomOrder()->take(3)->get();
            $subject -> teacher() -> attach($teacher);
            $subject -> save();
        });    
    }
}
