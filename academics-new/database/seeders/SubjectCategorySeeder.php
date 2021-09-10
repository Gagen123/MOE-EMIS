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
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 'b8d29a44-b8c7-11eb-b80d-b07b2586b8c6',
                'name' => 'Non-Academic',
                'dzo_name'=> '',
                'display_order'=>'2',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ]
        ]);
    }
    
}
