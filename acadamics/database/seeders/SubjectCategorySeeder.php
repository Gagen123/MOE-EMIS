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
                'id' => Str::uuid(),
                'name' => 'Academic',
                'status' => '1',
                'created_by' => 'd77d1e56-2b24-4b16-bc18-2b947d62018f',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Non-Academic',
                'status' => '1',
                'created_by' => 'd77d1e56-2b24-4b16-bc18-2b947d62018f',
                'created_at' => Carbon::now(),
            ]
        ]);
    }
    
}
