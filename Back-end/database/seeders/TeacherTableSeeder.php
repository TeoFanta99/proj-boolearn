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
        Teacher :: factory() -> count(10) -> make()->each(function($teacher){
            $user= User::inRandomOrder()->first();
            $teacher ->user()->associate($user);
            $teacher->save();

        });
    }
}
