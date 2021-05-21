<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssessmentTermSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('aca_assessment_term')->insert([
            [
                'id' => Str::uuid(),
                'aca_assmt_frequency_id' => '4d867b43-5cd2-11eb-9b9f-28f10e0628d5',
                'name'=>'First Term',
                'display_order'=>'1',
                'status' => '1',
                'created_by' => 'd77d1e56-2b24-4b16-bc18-2b947d62018f',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => Str::uuid(),
                'aca_assmt_frequency_id' => '4d867b43-5cd2-11eb-9b9f-28f10e0628d5',
                'name'=>'Second Term',
                'display_order'=>'2',
                'status' => '1',
                'created_by' => 'd77d1e56-2b24-4b16-bc18-2b947d62018f',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => Str::uuid(),
                'aca_assmt_frequency_id' => '4d866e4c-5cd2-11eb-9b9f-28f10e0628d5',
                'name'=>'Quarter I',
                'display_order'=>'3',
                'status' => '1',
                'created_by' => 'd77d1e56-2b24-4b16-bc18-2b947d62018f',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => Str::uuid(),
                'aca_assmt_frequency_id' => '4d866e4c-5cd2-11eb-9b9f-28f10e0628d5',
                'name'=>'Quarter II',
                'display_order'=>'4',
                'status' => '1',
                'created_by' => 'd77d1e56-2b24-4b16-bc18-2b947d62018f',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => Str::uuid(),
                'aca_assmt_frequency_id' => '4d866e4c-5cd2-11eb-9b9f-28f10e0628d5',
                'name'=>'Quarter III',
                'display_order'=>'5',
                'status' => '1',
                'created_by' => 'd77d1e56-2b24-4b16-bc18-2b947d62018f',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => Str::uuid(),
                'aca_assmt_frequency_id' => '4d866e4c-5cd2-11eb-9b9f-28f10e0628d5',
                'name'=>'Quarter IV',
                'display_order'=>'6',
                'status' => '1',
                'created_by' => 'd77d1e56-2b24-4b16-bc18-2b947d62018f',
                'created_at' => Carbon::now(),
            ],
            
          
        ]);
    }
}
