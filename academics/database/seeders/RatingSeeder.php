<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('aca_rating')->insert([
            [
                
                'id' => '2c51c8a6-b8c2-11eb-b80d-b07b2586b8c6',
                'aca_rating_type_id' => '2eefff10-b8c5-11eb-b80d-b07b2586b8c6',
                'name'=>'Need Improvement',
                'dzo_name'=> 'ཡར་དྲག་གཏང་དགོཔ།',
                'description' => 'Personal characteristics are below expectations',
                'score'=>'1',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => '204f3544-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_rating_type_id' => '2eefff10-b8c5-11eb-b80d-b07b2586b8c6',
                'name'=>'Good',
                'dzo_name'=> 'ལེགས་ཤོམ།',
                'description' => 'Personal characteristics are towards the expectations',
                'score'=>'2',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => '3a22aa4e-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_rating_type_id' => '2eefff10-b8c5-11eb-b80d-b07b2586b8c6',
                'name'=>'Very Good',
                'dzo_name'=> 'གནམ་མེད་ས་མེད་ལེགས་ཤོམ།',
                'description' => 'Personal characteristics meet expectations',
                'score'=>'3',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => '4747f296-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_rating_type_id' => '2eefff10-b8c5-11eb-b80d-b07b2586b8c6',
                'name'=>'Outstanding',
                'dzo_name'=> 'ཁྱད་འཕགས།',
                'description' => 'Personal characteristics are beyond expectations and targets',
                
                'score'=>'4',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => '54b29b7e-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_rating_type_id' => '4fdcc557-b8c5-11eb-b80d-b07b2586b8c6',
                'name'=>'Beginning',
                'dzo_name'=> 'གཞི་འཛུགས།',
                'description' => 'The student demonstrates competencies that are below expectations',
                'score'=>'1',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => '67fdfba5-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_rating_type_id' => '4fdcc557-b8c5-11eb-b80d-b07b2586b8c6',
                'name'=>'Approaching',
                'dzo_name'=> 'ཉེ་འབྱོར།',
                'description' => 'The student demonstrates competencies that are towards the expected competencies',
                'score'=>'2',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => '7881f340-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_rating_type_id' => '4fdcc557-b8c5-11eb-b80d-b07b2586b8c6',
                'name'=>'Meeting',
                'dzo_name'=> 'རེ་མཐུན།',
                'description' => 'The student demonstrates competencies that meet the expected competencies',
                'score'=>'3',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => '88ddb252-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_rating_type_id' => '4fdcc557-b8c5-11eb-b80d-b07b2586b8c6',
                'name'=>'Exceeding',
                'dzo_name'=> 'རྨད་བྱུང་།',
                'description' => 'The student demonstrates competencies beyond expectations and targets',
                'score'=>'4',
                'status' => '1',
                'created_by' => '013328f4-a381-4c6b-a270-8c071b366fc4',
                'created_at' => Carbon::now(),
            ]
        ]);
    }
}
