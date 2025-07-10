<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LivreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $livres = [];

        for ($i = 1; $i <= 20; $i++) {
            $livres[] = [
                'titre'      => 'Livre ' . $i,
                'auteur'     => 'Auteur ' . Str::random(5),
                'resume'     => 'Ceci est un résumé du livre ' . $i . '. ' . Str::random(100),
                'pdf_url'    => 'livre_' . $i . '.pdf',
                'isbn'       => '978-' . rand(100000000, 999999999),
                'quantite'   => rand(1, 10), 
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('livres')->insert($livres);
    }
}
