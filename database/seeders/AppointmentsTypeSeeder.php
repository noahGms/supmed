<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AppointmentsTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('appointments_types')->insert([
            'id' => 1,
            'name' => 'Physique'
        ],
        [
            'id' => 2,
            'name' => 'Virtuelle'
        ]
        );
    }
}
