<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sponsorship;
use App\Models\Teacher;
use Illuminate\Support\Carbon;

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
                'duration_hours' => '24:00:00',
                'price' => 2.99,
            ],
            [
                'name' => 'Pacchetto 72 ore',
                'duration_hours' => '72:00:00',
                'price' => 5.99,
            ],
            [
                'name' => 'Pacchetto 144 ore',
                'duration_hours' => '144:00:00',
                'price' => 9.99,
            ],
        ];

        foreach ($sponsorships as $sponsorshipData) {
            $sponsorship = Sponsorship::create([
                'name' => $sponsorshipData['name'],
                'duration' => $sponsorshipData['duration_hours'],
                'price' => $sponsorshipData['price'],
            ]);

            // Recupera un insegnante casuale
            $teacher = Teacher::inRandomOrder()->first();

            // Calcola la data di scadenza
            sscanf($sponsorshipData['duration_hours'], '%d:%d:%d', $hours, $minutes, $seconds);
            $expire_date = Carbon::now()
                ->addHours($hours)
                ->addMinutes($minutes)
                ->addSeconds($seconds);

            // Associa la sponsorizzazione all'insegnante con l'expire_date calcolata
            $sponsorship->teachers()->attach($teacher, ['expire_date' => $expire_date]);
        }
    }
}
