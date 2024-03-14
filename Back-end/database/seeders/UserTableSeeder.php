<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Teacher;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(20)->make()->each(function ($user) {
            $teacher = Teacher::factory()->make();
            $user->teacher()->save($teacher);

            $teacher->user()->save($user);
        })->save();
    }
}
