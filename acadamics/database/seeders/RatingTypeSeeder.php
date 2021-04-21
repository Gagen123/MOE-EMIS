<?php

namespace Database\Seeders;

use Carbon\Carbon;
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
                'id' => '08101ed8-5d3f-11eb-9b9f-28f10e0628d5',
                'name' => 'Four level rating (Need Improvement-Good-Very Good-Outstanding)',
                'status' => '1',
                'created_by' => 'd77d1e56-2b24-4b16-bc18-2b947d62018f',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => '2f31dfbb-5cc9-11eb-9b9f-28f10e0628d5',
                'name' => 'Four level rating (Beginning-Approaching-Meeting-Exceeding)',
                'status' => '1',
                'created_by' => 'd77d1e56-2b24-4b16-bc18-2b947d62018f',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => '2f320081-5cc9-11eb-9b9f-28f10e0628d5',
                'name' => 'Percentage marks',
                'status' => '1',
                'created_by' => 'd77d1e56-2b24-4b16-bc18-2b947d62018f',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => '6bece7ac-5d3b-11eb-9b9f-28f10e0628d5',
                'name' => 'Descriptive',
                'status' => '1',
                'created_by' => 'd77d1e56-2b24-4b16-bc18-2b947d62018f',
                'created_at' => Carbon::now(),
            ],
        ]);
    }
}
