<?php

namespace Database\Seeders;

use App\Models\Property;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OptionPropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Parcours tous les properties et ajoute des options
        foreach (Property::all() as $property) {
            $nbOptions=rand(2,5);
            $tblOptions=DB::table('options')->inRandomOrder()->limit($nbOptions)->pluck('id');
            $property->options()->sync($tblOptions);
        }
    }
}
