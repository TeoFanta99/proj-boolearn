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
        $sponsorships = [
            [
                'name' => 'Pacchetto 24 ore',
                'price' => 2.99,
                'duration_hours' => '24:00:00',
            ],
            [
                'name' => 'Pacchetto 72 ore',
                'price' => 5.99,
                'duration_hours' => '72:00:00',
            ],
            [
                'name' => 'Pacchetto 144 ore',
                'price' => 9.99,
                'duration_hours' => '144:00:00',
            ],
        ];
        
    
        foreach ($sponsorships as $sponsorshipData) {
            $sponsorship = new Sponsorship();
            $sponsorship->name = $sponsorshipData['name'];
            $sponsorship->duration = $sponsorshipData['duration_hours'];
            $sponsorship->price = $sponsorshipData['price'];
            $sponsorship->save();
            
            // Seleziona un insegnante casuale
            $teacher = Teacher::inRandomOrder()->first();
            
            // Calcola l'expire_date in base alla durata della sponsorizzazione
            sscanf($sponsorshipData['duration_hours'], '%d:%d:%d', $hours, $minutes, $seconds);
            $expireDate = Carbon::now()->addHours($hours)->addMinutes($minutes)->addSeconds($seconds);
            
            // Associa la sponsorizzazione all'insegnante con l'expire_date
            $sponsorship->teachers()->attach($teacher, ['expire_date' => $expireDate]);
        }
        
    }

        // $teacher = Teacher::inRandomOrder()->first();
        // $expireDate = Carbon::now()->addDays(rand(1, 30))->addHours(rand(1, 5));
        // $sponsorship->teacher()->attach($teacher, ['expire_date' => $expireDate]);
        // $sponsorship->save();

    
}
