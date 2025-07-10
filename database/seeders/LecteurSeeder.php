<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;


class LecteurSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('lecteurs')->truncate();
        DB::table('users')->truncate();
        Schema::enableForeignKeyConstraints();

        $personnes = [
            ['prenom' => 'Admin', 'nom' => 'Principal', 'telephone' => '99000000', 'email' => 'admin@gmail.com', 'fonction' => 'administrateur', 'est_abonne' => false],
            ['prenom' => 'Bib', 'nom' => 'Liothecaire', 'telephone' => '99000001', 'email' => 'biblio@gmail.com', 'fonction' => 'bibliothecaire', 'est_abonne' => false],
            ['prenom' => 'Jean', 'nom' => 'Koffi', 'telephone' => '99000111', 'email' => 'jean.koffi@gmail.com', 'fonction' => 'lecteur', 'est_abonne' => true],
            ['prenom' => 'Alice', 'nom' => 'Doe', 'telephone' => '99000222', 'email' => 'alice.doe@gmail.com', 'fonction' => 'lecteur', 'est_abonne' => true],
            ['prenom' => 'Kwame', 'nom' => 'Mensah', 'telephone' => '99000333', 'email' => 'kwame.mensah@gmail.com', 'fonction' => 'lecteur', 'est_abonne' => false],
            ['prenom' => 'Mireille', 'nom' => 'Akou', 'telephone' => '99000444', 'email' => 'mireille.akou@gmail.com', 'fonction' => 'lecteur', 'est_abonne' => true],
            ['prenom' => 'Abdoulaye', 'nom' => 'Sow', 'telephone' => '99000555', 'email' => 'abdoulaye.sow@gmail.com', 'fonction' => 'lecteur', 'est_abonne' => true],
            ['prenom' => 'Edem', 'nom' => 'Lawson', 'telephone' => '99000666', 'email' => 'edem.lawson@gmail.com', 'fonction' => 'lecteur', 'est_abonne' => false],
            ['prenom' => 'Fatou', 'nom' => 'Amadou', 'telephone' => '99000777', 'email' => 'fatou.amadou@gmail.com', 'fonction' => 'lecteur', 'est_abonne' => true],
            ['prenom' => 'Issa', 'nom' => 'Bako', 'telephone' => '99000888', 'email' => 'issa.bako@gmail.com', 'fonction' => 'bibliothecaire', 'est_abonne' => false],
            ['prenom' => 'Chantal', 'nom' => 'Ayaba', 'telephone' => '99000999', 'email' => 'chantal.ayaba@gmail.com', 'fonction' => 'lecteur', 'est_abonne' => false],
            ['prenom' => 'Moussa', 'nom' => 'Traoré', 'telephone' => '99001000', 'email' => 'moussa.traore@gmail.com', 'fonction' => 'lecteur', 'est_abonne' => true],
        ];

        foreach ($personnes as &$personne) {
           
            if (!in_array($personne['fonction'], ['administrateur', 'bibliothecaire'])) {
                $personne['fonction'] = 'lecteur';
            }
        }
        unset($personne); 

        foreach ($personnes as $personne) {
            
            $userId = DB::table('users')->insertGetId([
                'name' => $personne['prenom'] . ' ' . $personne['nom'],
                'email' => $personne['email'],
                'fonction' => $personne['fonction'],
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

          
            if ($personne['fonction'] === 'lecteur') {
                DB::table('lecteurs')->insert([
                    'user_id' => $userId,
                    'est_abonne' => $personne['est_abonne'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
