<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Page::create([
            'route' => 'home',
            'title' => 'hallo_alexa_',
            'description' => 'Hi! Mein Name ist Alexa, komme aus Frankfurt am Main und streame seit dem 12. April 2020 auf Twitch. Meine Community ist aufgeschlossen, freundlich und familiär!',
            'robots' => 3,
        ]);
        Page::create([
            'route' => 'contact',
            'title' => 'Kontakt',
            'description' => 'Hier kannst Kontakt mit Alexa von `hallo_alexa_` aufnehmen.',
            'robots' => 3,
        ]);
    }
}
