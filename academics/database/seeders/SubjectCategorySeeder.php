<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('aca_subject_category')->insert([
            [
                'id' => 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6',
                'name' => 'Academic',
                'dzo_name'=> '',
                'display_order'=>'1',
                'status' => '1',
                'created_by' => 'd77d1e56-2b24-4b16-bc18-2b947d62018f',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 'b8d29a44-b8c7-11eb-b80d-b07b2586b8c6',
                'name' => 'Non-Academic',
                'dzo_name'=> '',
                'display_order'=>'2',
                'status' => '1',
                'created_by' => 'd77d1e56-2b24-4b16-bc18-2b947d62018f',
                'created_at' => Carbon::now(),
            ]
        ]);
    }
    
}
