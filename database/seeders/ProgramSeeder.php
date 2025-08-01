<?php

namespace Database\Seeders;

use App\Models\Program;
use Illuminate\Database\Seeder;

class ProgramSeeder extends Seeder
{
    public function run(): void
    {
        // Create Taekwondo program if it doesn't exist
        $taekwondo = Program::whereTranslation('title', 'Taekwondo')->first();
        
        if (!$taekwondo) {
            $taekwondo = Program::create([
                'published' => true,
                'position' => 1,
            ]);
            
            $taekwondo->translateOrNew('en')->title = 'Taekwondo';
            $taekwondo->translateOrNew('en')->tagline = 'The Art of Kicking and Punching';
            $taekwondo->save();
            
            // Create a slug
            $taekwondo->slugs()->create([
                'slug' => 'taekwondo',
                'locale' => 'en',
                'active' => true,
            ]);
            
            // Add some sample block content
            $taekwondo->blocks()->create([
                'blockable_type' => Program::class,
                'blockable_id' => $taekwondo->id,
                'position' => 1,
                'content' => json_encode([
                    'title' => 'Welcome to Taekwondo',
                    'text' => '<p>This is sample block content for the Taekwondo program. You can edit this in the Twill admin panel.</p>'
                ]),
                'type' => 'common-text',
                'child_key' => null,
                'parent_id' => null,
            ]);
        }
    }
}