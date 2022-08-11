<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class LocationCenterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $locations = [
            [
                'loc_city' => 'Cebu City',
                'loc_name' => 'Basak Elementary School'
            ],
            [
                'loc_city' => 'Cebu City',
                'loc_name' => 'Pardo Elementary School'
            ],
            [
                'loc_city' => 'Cebu City',
                'loc_name' => 'Lahug Elementary School'
            ],
            [
                'loc_city' => 'Talisay City',
                'loc_name' => 'Tabunok elementary school'
            ],
        ];

        DB::table('learning_center')->insert($locations);
    }
}
