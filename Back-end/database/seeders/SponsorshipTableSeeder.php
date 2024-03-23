<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
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
            $expireDate = Carbon::now()->addDays(rand(1, 30))->addHours(rand(1,5));
            $sponsorship->teacher()->attach($teacher, ['expire_date' => $expireDate]);
            $sponsorship -> save();
        });  
    }
}
