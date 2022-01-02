<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Link;

class LinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Link::create([
            'active' => true,
            'icon'   => 'fab fa-twitch',
            'name'   => 'Twitch',
            'target' => 'https://www.twitch.tv/hallo_alexa_',
            'color'  => '#6441a5',
        ]);
        Link::create([
            'active' => true,
            'icon'   => 'fab fa-instagram',
            'name'   => 'Instagram',
            'target' => 'https://www.instagram.com/hallo_alexa_/',
            'color'  => '#e1306c',
        ]);
        Link::create([
            'active' => true,
            'icon'   => 'fab fa-tiktok',
            'name'   => 'TikTok',
            'target' => 'https://www.tiktok.com/@hallo_alexa_',
            'color'  => '#ff0000',
        ]);
        Link::create([
            'active' => true,
            'icon'   => 'fab fa-twitter',
            'name'   => 'Twitter',
            'target' => 'https://twitter.com/alexa_hallo',
            'color'  => '#1da1f2',
        ]);
        Link::create([
            'active' => true,
            'icon'   => 'fab fa-facebook',
            'name'   => 'Facebook',
            'target' => 'https://www.facebook.com/hallo_alexa_-101553671528532/',
            'color'  => '#3b5998',
        ]);
        Link::create([
            'active' => true,
            'icon'   => 'fab fa-discord',
            'name'   => 'Discord',
            'target' => 'https://discord.gg/fCUT5bF',
            'color'  => '#7289da',
        ]);
        Link::create([
            'active' => true,
            'icon'   => 'fab fa-youtube',
            'name'   => 'YouTube',
            'target' => 'https://www.youtube.com/channel/UCetTw1t8fMGzWeYo1_X3vqQ',
            'color'  => '#ff0000',
        ]);
    }
}
