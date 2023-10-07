<?php

namespace Database\Seeders;

use App\Models\Option;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tblOptions= [
            'Ascenceur',
            'Jacuzzi',
            'Accès PMR',
            'Chauffage au gaz',
            'Piscine',
            'Commerce de proximité',
            'Transport en commun',
            'Marché à proximité',
            'Jardin',
            'Terrasse',
            'Balcon',
            'Meublé',
            'Internet Fibre',
            'Garage à voiture',
            'Garage à vélo',
            'Sans travaux'
        ];

        foreach ($tblOptions as $optionLabel) {
            $option = new Option();
            $option->name=$optionLabel;
            $option->save();
        }
    }
}
