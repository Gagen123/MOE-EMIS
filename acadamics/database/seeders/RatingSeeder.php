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
                
                'id' => Str::uuid(),
                'aca_rating_type_id' => '08101ed8-5d3f-11eb-9b9f-28f10e0628d5',
                'name'=>'Need Improvement',
                'score'=>'1',
                'status' => '1',
                'created_by' => 'd77d1e56-2b24-4b16-bc18-2b947d62018f',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => Str::uuid(),
                'aca_rating_type_id' => '08101ed8-5d3f-11eb-9b9f-28f10e0628d5',
                'name'=>'Good',
                'score'=>'2',
                'status' => '1',
                'created_by' => 'd77d1e56-2b24-4b16-bc18-2b947d62018f',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => Str::uuid(),
                'aca_rating_type_id' => '08101ed8-5d3f-11eb-9b9f-28f10e0628d5',
                'name'=>'Very Good',
                'score'=>'3',
                'status' => '1',
                'created_by' => 'd77d1e56-2b24-4b16-bc18-2b947d62018f',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => Str::uuid(),
                'aca_rating_type_id' => '08101ed8-5d3f-11eb-9b9f-28f10e0628d5',
                'name'=>'Outstanding',
                'score'=>'4',
                'status' => '1',
                'created_by' => 'd77d1e56-2b24-4b16-bc18-2b947d62018f',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => Str::uuid(),
                'aca_rating_type_id' => '2f31dfbb-5cc9-11eb-9b9f-28f10e0628d5',
                'name'=>'Beginning',
                'score'=>'1',
                'status' => '1',
                'created_by' => 'd77d1e56-2b24-4b16-bc18-2b947d62018f',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => Str::uuid(),
                'aca_rating_type_id' => '2f31dfbb-5cc9-11eb-9b9f-28f10e0628d5',
                'name'=>'Approaching',
                'score'=>'2',
                'status' => '1',
                'created_by' => 'd77d1e56-2b24-4b16-bc18-2b947d62018f',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => Str::uuid(),
                'aca_rating_type_id' => '2f31dfbb-5cc9-11eb-9b9f-28f10e0628d5',
                'name'=>'Meeting',
                'score'=>'3',
                'status' => '1',
                'created_by' => 'd77d1e56-2b24-4b16-bc18-2b947d62018f',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => Str::uuid(),
                'aca_rating_type_id' => '2f31dfbb-5cc9-11eb-9b9f-28f10e0628d5',
                'name'=>'Exceeding',
                'score'=>'4',
                'status' => '1',
                'created_by' => 'd77d1e56-2b24-4b16-bc18-2b947d62018f',
                'created_at' => Carbon::now(),
            ]
        ]);
    }
}
