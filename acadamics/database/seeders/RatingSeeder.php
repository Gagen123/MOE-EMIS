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
                'score'=>'1',
                'status' => '1',
                'created_by' => 'd77d1e56-2b24-4b16-bc18-2b947d62018f',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => '204f3544-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_rating_type_id' => '2eefff10-b8c5-11eb-b80d-b07b2586b8c6',
                'name'=>'Good',
                'score'=>'2',
                'status' => '1',
                'created_by' => 'd77d1e56-2b24-4b16-bc18-2b947d62018f',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => '3a22aa4e-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_rating_type_id' => '2eefff10-b8c5-11eb-b80d-b07b2586b8c6',
                'name'=>'Very Good',
                'score'=>'3',
                'status' => '1',
                'created_by' => 'd77d1e56-2b24-4b16-bc18-2b947d62018f',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => '4747f296-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_rating_type_id' => '2eefff10-b8c5-11eb-b80d-b07b2586b8c6',
                'name'=>'Outstanding',
                'score'=>'4',
                'status' => '1',
                'created_by' => 'd77d1e56-2b24-4b16-bc18-2b947d62018f',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => '54b29b7e-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_rating_type_id' => '4fdcc557-b8c5-11eb-b80d-b07b2586b8c6',
                'name'=>'Beginning',
                'score'=>'1',
                'status' => '1',
                'created_by' => 'd77d1e56-2b24-4b16-bc18-2b947d62018f',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => '67fdfba5-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_rating_type_id' => '4fdcc557-b8c5-11eb-b80d-b07b2586b8c6',
                'name'=>'Approaching',
                'score'=>'2',
                'status' => '1',
                'created_by' => 'd77d1e56-2b24-4b16-bc18-2b947d62018f',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => '7881f340-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_rating_type_id' => '4fdcc557-b8c5-11eb-b80d-b07b2586b8c6',
                'name'=>'Meeting',
                'score'=>'3',
                'status' => '1',
                'created_by' => 'd77d1e56-2b24-4b16-bc18-2b947d62018f',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => '88ddb252-b8c7-11eb-b80d-b07b2586b8c6',
                'aca_rating_type_id' => '4fdcc557-b8c5-11eb-b80d-b07b2586b8c6',
                'name'=>'Exceeding',
                'score'=>'4',
                'status' => '1',
                'created_by' => 'd77d1e56-2b24-4b16-bc18-2b947d62018f',
                'created_at' => Carbon::now(),
            ]
        ]);
    }
}
