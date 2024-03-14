<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Message;
use App\Models\Teacher;

class MessageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Message :: factory() -> count(10) -> make() -> each(function($message) {
            $teacher = Teacher :: inRandomOrder() -> first();
            $message -> teacher() -> associate($teacher);
            $message -> save();
        });
    }
}
