<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('aca_subject_group')->insert([
            [
                'id' => 'de4c45a0-b8c7-11eb-b80d-b07b2586b8c6',
                'name' => 'Science',
                'dzo_name'=> '',
                'display_order'=>'1',
                'status' => '1',
                'created_by' => 'd77d1e56-2b24-4b16-bc18-2b947d62018f',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 'ec56c881-b8c7-11eb-b80d-b07b2586b8c6',
                'name' => 'English',
                'dzo_name'=> '',
                'display_order'=>'2',
                'status' => '1',
                'created_by' => 'd77d1e56-2b24-4b16-bc18-2b947d62018f',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 'f4610935-b8c7-11eb-b80d-b07b2586b8c6',
                'name' => 'Dzongkha',
                'dzo_name'=> '',
                'display_order'=>'3',
                'status' => '1',
                'created_by' => 'd77d1e56-2b24-4b16-bc18-2b947d62018f',
                'created_at' => Carbon::now(),
            ]
        ]);
        
    }
}
