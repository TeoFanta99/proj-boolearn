<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sponsorship;
use App\Models\Teacher;

class SponsorshipTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sponsorship :: factory() -> count(3) -> create() -> each(function($sponsorship) {
            $teacher = Teacher :: inRandomOrder() -> first();
            $sponsorship -> teacher() -> attach($teacher);
            $sponsorship -> save();
        });  
    }
}
