<?php

namespace Database\Seeders;

use App\Models\Promoter;
use App\Models\Skill;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PromoterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Promoter::factory()->count(10)->create()->each(function ($promoter) {
            // For each created Promoter
            // Important: Ensure that skills are created first
            // Associate randomly selected Skills with the Promoter
            $skills = Skill::inRandomOrder()->limit(3)->get();
            $promoter->skills()->attach($skills);
        });
    }
}
