<?php

namespace Database\Seeders;

use App\Models\equipes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EquipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //equipes::truncate(); //is used to delete all the records from a database table and reset the auto-incrementing ID to 1.
        
        equipes::create([
            'nom_equipe'=>'Espérance sportive de Tunis',
            'adresse'=>' Parc Hassèn Belkhodja, Av. Mohamed V, Tunis B.P. 700, Tunis RP 1000 Tunis',
            'pays'=>'Tunis',
            'logo'=>asset('images/Espérance.png'),
            'site_web'=>'www.site.com',
            'type_equipe'=>'national',
            'description'=>'est un club omnisports tunisien basé à Tunis et fondé en 1919 dans le quartier de Bab Souika. Il est principalement reconnu pour sa section de football.',
        ]);

        equipes::create([
            'nom_equipe'=>'etoile sportive du sahel',
            'adresse'=>'AVENUE MED KAROUI, BP68. 4121 SOUSSE SOUSSE.',
            'pays'=>'Tunis',
            'logo'=>asset('images/Etoile.png'),
            'site_web'=>'www.site2.com',
            'type_equipe'=>'national',
            'description'=>'est un club omnisports tunisien fondé le 11 mai 1925 et basé à Sousse. Il compte un total de huit sections actives en football, handball, volley-ball, basket-ball, lutte, judo, gymnastique et boxe.',
        ]);
    }
}
