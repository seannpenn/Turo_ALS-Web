<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data = [
            'userType' => 1,
            'username' => 'seanpinote',
            'password' => bcrypt('sean123'),
            'email' => 'spinote16@gmail.com',

        ];

        DB::table('users')->insert($data);
    }
}
