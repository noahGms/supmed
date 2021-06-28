<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('addresses')->insert([
            'id' => 1,
            'street_number' => '1',
            'street_name' => 'place des poiriers',
            'zipcode' => '69008',
            'city' => 'Lyon'
        ]);

        DB::table('persons')->insert([
            'email' => 'root@supmed.com',
            'password' => Hash::make('root'),
            'firstname' => 'root',
            'lastname' => 'root',
            'phone' => '0656065345',
            'role' => 'admin',
            'address_id' => 1,
            'updated_at' => Carbon::now(),
            'created_at' => Carbon::now()
        ]);
    }
}
