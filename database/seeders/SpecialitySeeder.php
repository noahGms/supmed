<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecialitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('specialities')->insert([
            [
                'id' => 1,
                'name' => 'Chirurgie',
                'description' => 'La chirurgie est la partie de la thérapeutique qui implique des opérations internes ou des manœuvres externes sur les tissus, notamment par incision et suture.'
            ],
            [
                'id' => 2,
                'name' => 'Dermatologie',
                'description' => 'La dermatologie est une spécialité de médecine qui s\'occupe de la peau, des muqueuses et des phanères (ongles, cheveux, poils).'
            ],
            [
                'id' => 3,
                'name' => 'Oncologie',
                'description' => 'L\'oncologie ou carcinologie ou cancérologie est la spécialité médicale d\'étude, de diagnostic et de traitement des cancers.'
            ],
            [
                'id' => 4,
                'name' => 'Généraliste',
                'description' => 'Le médecin généraliste, aussi appelé médecin omnipraticien ou médecin de famille, est donc souvent consulté pour diagnostiquer les symptômes avant de traiter la maladie ou de référer le patient à un autre médecin spécialiste.'
            ]
        ]);
    }
}
