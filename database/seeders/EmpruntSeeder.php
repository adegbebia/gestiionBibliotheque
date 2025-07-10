<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Lecteur;

class EmpruntSeeder extends Seeder
{
    public function run(): void
    {
 
        DB::table('emprunts')->delete();

        

        

      
        $lecteurs = Lecteur::pluck('lecteur_id')->toArray();

        // // Vérification : assez de lecteurs ?
        // if (count($lecteurs) < 10) {
        //     dd("Pas assez de lecteurs dans la table lecteurs. Il en faut au moins 10.");
        // }

     
        $emprunts = [
            [
                'date_debut' => '2025-06-01',
                'date_retour' => '2025-06-10',
                //'user_id' => $aimane->user_id,
                'lecteur_id' => $lecteurs[0],
            ],
            [
                'date_debut' => '2025-06-02',
                'date_retour' => '2025-06-11',
                //'user_id' => $fatima->user_id,
                'lecteur_id' => $lecteurs[1],
            ],
            [
                'date_debut' => '2025-06-03',
                'date_retour' => '2025-06-12',
                //'user_id' => $youssouf->user_id,
                'lecteur_id' => $lecteurs[2],
            ],
            [
                'date_debut' => '2025-06-04',
                'date_retour' => '2025-06-13',
                //'user_id' => $aimane->user_id,
                'lecteur_id' => $lecteurs[3],
            ],
            [
                'date_debut' => '2025-06-05',
                'date_retour' => '2025-06-14',
                //'user_id' => $fatima->user_id,
                'lecteur_id' => $lecteurs[4],
            ],
            [
                'date_debut' => '2025-06-06',
                'date_retour' => '2025-06-15',
                //'user_id' => $youssouf->user_id,
                'lecteur_id' => $lecteurs[5],
            ],
            [
                'date_debut' => '2025-06-07',
                'date_retour' => '2025-06-16',
                //'user_id' => $aimane->user_id,
                'lecteur_id' => $lecteurs[6],
            ],
            [
                'date_debut' => '2025-06-08',
                'date_retour' => '2025-06-17',
                //'user_id' => $fatima->user_id,
                'lecteur_id' => $lecteurs[7],
            ],
            [
                'date_debut' => '2025-06-09',
                'date_retour' => '2025-06-18',
                //'user_id' => $youssouf->user_id,
                'lecteur_id' => $lecteurs[8],
            ],
            // [
            //     'date_debut' => '2025-06-10',
            //     'date_retour' => '2025-06-19',
            //     //'user_id' => $aimane->user_id,
            //     'lecteur_id' => $lecteurs[9],
            // ],
        ];

        // Ajouter timestamps
        foreach ($emprunts as &$e) {
            $e['created_at'] = now();
            $e['updated_at'] = now();
        }

        // Insertion dans la table
        DB::table('emprunts')->insert($emprunts);
    }
}
