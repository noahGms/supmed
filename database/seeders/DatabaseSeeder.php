<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // TODO: add address
        DB::table('persons')->insert([
            'email' => 'root@example.com',
            'password' => Hash::make('root'),
            'firstname' => 'root',
            'lastname' => 'root',
            'phone' => '0656065345',
            'role' => 'admin'
        ]);
    }
}
