<?php

namespace Database\Seeders;

use App\Models\Property;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nbPropertiesToCreate = 50;

        $faker=\Faker\Factory::create();

        for ($i=0;$i<$nbPropertiesToCreate;$i++) {
            $property = new Property();

            $property->title=($i+1)." Propriété de ".$faker->name();
            $description='';
            for ($j=0;$j<5;$j++) {
                $description.=(' '.$faker->text());
            }
            $property->description=$description;
            $property->surface=rand(40,1000);
            $property->rooms=rand(0,10);
            $property->bedrooms=rand(0,10);
            $property->floor=rand(0,6);
            $property->price=rand(50000,600000);
            $property->city='Hénin-Beaumont';
            $property->address=rand(1,30). ' rue de '.$faker->name();
            $property->postal_code='62110';
            $property->sold=rand(0,1);
            $property->save();
        }
    }
}
