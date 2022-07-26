<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $programs = [
            [
                'prog_fname' => 'Basic Literacy Program',
                'prog_sname' => 'BLP'
            ],
            [
                'prog_fname' => 'Accreditation and Equivalency Program',
                'prog_sname' => 'AEP'
            ],
        ];

        DB::table('programs')->insert($programs);
    }
}
