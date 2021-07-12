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
                'id' => '0147ff87-b8c1-11eb-b80d-b07b2586b8c6',
                'aca_assmt_frequency_id' => 'e3cc5557-b8c0-11eb-b80d-b07b2586b8c6',
                'name'=>'First Term',
                'dzo_name'=> 'སློབ་དུས་ ༡ པ།',
                'display_text' => '',
                'from_month' => '2',
                'to_month' => '6',
                'from_date'=>'1',
                'to_date'=>'15',
                'display_order'=>'1',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => '5f1bf047-b8c1-11eb-b80d-b07b2586b8c6',
                'aca_assmt_frequency_id' => 'e3cc5557-b8c0-11eb-b80d-b07b2586b8c6',
                'name'=>'Second Term',
                'dzo_name'=> 'སློབ་དུས་ ༢ པ།',
                'display_text' => '',
                'from_month' => '7',
                'to_month' => '12',
                'from_date'=>'1',
                'to_date'=>'30',
                'display_order'=>'2',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => '7d662b7d-b8c1-11eb-b80d-b07b2586b8c6',
                'aca_assmt_frequency_id' => 'c5815af7-b8c0-11eb-b80d-b07b2586b8c6',
                'name'=>'Quarter I',
                'dzo_name'=> 'བཞི་དཔྱ་ ༡ པ།',
                'display_text' => 'February - Mid April',
                'from_month' => '2',
                'to_month' => '4',
                'from_date'=>'1',
                'to_date'=>'15',
                'display_order'=>'3',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 'a3e65b7b-b8c1-11eb-b80d-b07b2586b8c6',
                'aca_assmt_frequency_id' => 'c5815af7-b8c0-11eb-b80d-b07b2586b8c6',
                'name'=>'Quarter II',
                'dzo_name'=> 'བཞི་དཔྱ་ ༢ པ།',
                'display_text' => 'Mid April - June',
                'from_month' => '4',
                'to_month' => '6',
                'from_date'=>'16',
                'to_date'=>'30',
                'display_order'=>'4',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 'c6e9a293-b8c1-11eb-b80d-b07b2586b8c6',
                'aca_assmt_frequency_id' => 'c5815af7-b8c0-11eb-b80d-b07b2586b8c6',
                'name'=>'Quarter III',
                'dzo_name'=> 'བཞི་དཔྱ་ ༣ པ།',
                'display_text' => 'July - Mid October',
                'from_month' => '7',
                'to_month' => '10',
                'from_date'=>'1',
                'to_date'=>'15',
                'display_order'=>'5',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 'e8274e75-b8c1-11eb-b80d-b07b2586b8c6',
                'aca_assmt_frequency_id' => 'c5815af7-b8c0-11eb-b80d-b07b2586b8c6',
                'name'=>'Quarter IV',
                'dzo_name'=> 'བཞི་དཔྱ་ ༤ པ།',
                'display_text' => 'Mid October - December',
                'from_month' => '10',
                'to_month' => '12',
                'from_date'=>'16',
                'to_date'=>'30',
                'display_order'=>'6',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],
            
          
        ]);
    }
}
