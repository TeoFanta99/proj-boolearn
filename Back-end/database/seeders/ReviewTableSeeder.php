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
        Review :: factory() -> count(10) -> make() -> each(function($review) {
            $teacher = Teacher :: inRandomOrder() -> first();
            $review -> teacher() -> associate($teacher);
            $review -> save();
        });
    }
}
