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
                'status' => '1',
                'created_by' => 'd77d1e56-2b24-4b16-bc18-2b947d62018f',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 'e3cc5557-b8c0-11eb-b80d-b07b2586b8c6',
                'name'=>'Half Yearly',
                'status' => '1',
                'created_by' => 'd77d1e56-2b24-4b16-bc18-2b947d62018f',
                'created_at' => Carbon::now(),
            ],
          
        ]);
    }
}
