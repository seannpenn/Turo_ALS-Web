<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class QuestionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            [
                'type_name' => 'Multiple Choice'
            ],
            [
                'type_name' => 'Short answer'
            ],
            [
                'type_name' => 'Checkboxes'
            ],
        ];
        DB::table('question_type')->insert($types);
    }
}
