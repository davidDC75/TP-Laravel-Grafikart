<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // commande pour lancer : php artisan db:seed UserSeeder
        // Création utilisateur de test
        $user=User::create([
            'name' => 's3g',
            'email' => 'test@test.fr',
            'password' => \Hash::make('test')
        ]);
        $user->save();
    }
}
