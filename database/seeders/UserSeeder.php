<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'     => 'Norman',
            'email'    => 'norman@huth.it',
            'password' => Hash::make('secret'),
        ]);
        User::create([
            'name'     => 'Alexa',
            'email'    => 'kontakt@hallo-alexa.de',
            'password' => Hash::make('secret'),
        ]);
    }
}
