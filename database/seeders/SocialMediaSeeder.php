<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin\SocialMedia;

class SocialMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SocialMedia::insert([
            'facebook' => 'https://www.facebook.com/',
            'whatsapp' => '7028489282',
            'youtube' => 'https://www.youtube.com',
            'instagram' => 'https://www.instagram.com/',
            'phone' => '7028489282',
            'address' => 'Address',
            'email' => 'hi@prashanttanwar.com',
            'address_link' => 'ss',
        ]);
    }
}
