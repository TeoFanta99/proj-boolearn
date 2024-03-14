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
        
        Rating :: factory() -> count(5) -> create() -> each(function($rating) {
            $teacher = Teacher :: inRandomOrder() -> first();
            $rating -> teacher() -> attach($teacher);
            $rating -> save();
        });  
    }
}
