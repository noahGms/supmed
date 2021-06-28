<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('addresses')->insert([
            [
                'id' => 2,
                'street_number' => '234',
                'street_name' => 'rue des marchers',
                'zipcode' => '69004',
                'city' => 'Lyon'
            ],
            [
                'id' => 3,
                'street_number' => '111',
                'street_name' => 'chemin des plans',
                'zipcode' => '01000',
                'city' => 'Bourg-en-bresse'
            ],
            [
                'id' => 4,
                'street_number' => '67',
                'street_name' => 'route de l\'étang',
                'zipcode' => '01340',
                'city' => 'Montrevel-en-Bresse'
            ],
            [
                'id' => 5,
                'street_number' => '156',
                'street_name' => 'avenue des sangliers',
                'zipcode' => '75003',
                'city' => 'Paris'
            ]
        ]);

        DB::table('persons')->insert([
            [
                'id' => 2,
                'email' => 'edward.martin@gmail.com',
                'password' => Hash::make('password'),
                'firstname' => 'Edward',
                'lastname' => 'Martin',
                'phone' => '0767864723',
                'role' => 'doctor',
                'address_id' => 2,
                'updated_at' => Carbon::now(),
                'created_at' => Carbon::now()
            ],
            [
                'id' => 3,
                'email' => 'jean.paul@gmail.com',
                'password' => Hash::make('password'),
                'firstname' => 'Jean',
                'lastname' => 'Paul',
                'phone' => '0876763476',
                'role' => 'doctor',
                'address_id' => 3,
                'updated_at' => Carbon::now(),
                'created_at' => Carbon::now()
            ],
            [
                'id' => 4,
                'email' => 'phil.collins@gmail.com',
                'password' => Hash::make('password'),
                'firstname' => 'Phil',
                'lastname' => 'Collins',
                'phone' => '0987456342',
                'role' => 'doctor',
                'address_id' => 4,
                'updated_at' => Carbon::now(),
                'created_at' => Carbon::now()
            ],
            [
                'id' => 5,
                'email' => 'catherine.defournaux@gmail.com',
                'password' => Hash::make('password'),
                'firstname' => 'Catherine',
                'lastname' => 'Defournaux',
                'phone' => '0563783912',
                'role' => 'doctor',
                'address_id' => 5,
                'updated_at' => Carbon::now(),
                'created_at' => Carbon::now()
            ]
        ]);

        DB::table('doctors')->insert([
            ['person_id' => 2],
            ['person_id' => 3],
            ['person_id' => 4],
            ['person_id' => 5],
        ]);

        DB::table('speciality_doctor')->insert([
            ['doctor_id' => 2, 'speciality_id' => 1],
            ['doctor_id' => 3, 'speciality_id' => 2],
            ['doctor_id' => 4, 'speciality_id' => 3],
            ['doctor_id' => 5, 'speciality_id' => 4],
        ]);
    }
}
