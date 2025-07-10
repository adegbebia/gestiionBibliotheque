<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run(): void
    {
       
        Schema::disableForeignKeyConstraints();

        DB::table('emprunts')->delete();
        DB::table('lecteurs')->delete();
        DB::table('users')->delete();

        Schema::enableForeignKeyConstraints();

        $fonctions = ['administrateur', 'bibliothecaire', 'lecteur'];
        $users = [];

        for ($i = 1; $i <=5; $i++) {
            $prenom = 'Prenom' . $i;
            $nom = 'Nom' . $i;

           
            $name = $prenom . ' ' . $nom;
            $email = strtolower($prenom . '.' . $nom) . '@gmail.com';
            $fonction = $fonctions[array_rand($fonctions)];

            $users[] = [
                'name' => $name,
                'email' => $email,
                'fonction' => $fonction,
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('users')->insert($users);
    }
}
