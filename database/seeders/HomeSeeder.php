<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Repositories\HomeRepository;
use App\Models\Home;

class HomeSeeder extends Seeder
{
    /**
     * Create the database record for this singleton module.
     *
     * @return void
     */
    public function run()
    {
        if (Home::count() > 0) {
            return;
        }

        app(HomeRepository::class)->create([
            'title' => [
                'en' => 'Home',
                // add other languages here
            ],
            'description' => [
                'en' => '',
                // add other languages here
            ],
            'published' => false,
        ]);
    }
}
