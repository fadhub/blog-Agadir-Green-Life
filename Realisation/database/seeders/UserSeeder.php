<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Création de l'utilisateur admin s'il n'existe pas déjà
        User::firstOrCreate(
            ['email' => 'admin@bleu.ma'],
            [
                'name' => 'SAMI MOHAMED',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]
        );

        // Création de 7 utilisateurs de test avec des emails uniques
        for ($i = 0; $i < 7; $i++) {
            User::factory()->create([
                'email' => 'user' . ($i + 1) . '@example.com'
            ]);
        }
    }
}