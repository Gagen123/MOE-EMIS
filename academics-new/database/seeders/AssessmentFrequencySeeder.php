<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssessmentFrequencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('aca_assessment_frequency')->insert([
            [
                'id' => 'c5815af7-b8c0-11eb-b80d-b07b2586b8c6',
                'name'=>'Quarterly',
                'not_assessed' => '0',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 'e3cc5557-b8c0-11eb-b80d-b07b2586b8c6',
                'name'=>'Half Yearly',
                'not_assessed' => '0',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 'b11b216c-c5d4-11eb-870b-e89eb413ce43',
                'name'=>'Not Assessed',
                'not_assessed' => '1',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ]
          
        ]);
    }
}
