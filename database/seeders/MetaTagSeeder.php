<?php

namespace Database\Seeders;

use App\Models\Admin\PageSeo;
use Illuminate\Database\Seeder;

class MetaTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PageSeo::create([
            'url' => '/',
            'metaTags' => '{"title":"Home","description":null,"image":null}'
        ]);

        PageSeo::create([
            'url' => '/about',
            'metaTags' => '{"title":"About","description":null,"image":null}'


        ]);

        PageSeo::create([
            'url' => '/portfolio',
            'metaTags' => '{"title":"Portfolio","description":null,"image":null}'


        ]);

        PageSeo::create([
            'url' => '/contact',
            'metaTags' => '{"title":"Contact","description":null,"image":null}'


        ]);
    }
}
