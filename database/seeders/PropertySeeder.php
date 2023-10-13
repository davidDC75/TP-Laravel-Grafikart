<?php

namespace Database\Seeders;

use App\Models\Option;
use App\Models\Property;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $options=Option::all();
        // Utilise le factory pour créer les biens
        Property::factory(30)
            /*
             * Pratique mais renvoie toujours les mêmes options
            ->hasAttached($options->random(5))
            */
            ->create();
    }
}
