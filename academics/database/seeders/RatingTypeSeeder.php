<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RatingTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('aca_rating_type')->insert([
            [
                'id' => '2eefff10-b8c5-11eb-b80d-b07b2586b8c6',
                'name' => 'Four level rating (Need Improvement-Good-Very Good-Outstanding)',
                'input_type'=>'0',
                'status' => '1',
                'created_by' => 'd77d1e56-2b24-4b16-bc18-2b947d62018f',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => '4fdcc557-b8c5-11eb-b80d-b07b2586b8c6',
                'name' => 'Four level rating (Beginning-Approaching-Meeting-Exceeding)',
                'input_type'=>'0',
                'status' => '1',
                'created_by' => 'd77d1e56-2b24-4b16-bc18-2b947d62018f',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => '643c845c-b8c5-11eb-b80d-b07b2586b8c6',
                'name' => 'Percentage marks',
                'input_type'=>'1',
                'status' => '1',
                'created_by' => 'd77d1e56-2b24-4b16-bc18-2b947d62018f',
                'created_at' => Carbon::now(),
            ],
            [
               
                'id' => 'ad1aacc8-b8c5-11eb-b80d-b07b2586b8c6',
                'name' => 'Descriptive',
                'input_type'=>'2',
                'status' => '1',
                'created_by' => 'd77d1e56-2b24-4b16-bc18-2b947d62018f',
                'created_at' => Carbon::now(),
            ],
        ]);
    }
}
