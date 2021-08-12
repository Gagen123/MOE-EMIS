<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('spm_status')->insert([
            [
                'id' => '0',
                'name' => 'Not Assessed',
                'created_by' => 'D'
            ],
            [
                'id' => '1',
                'name' => 'In draft with DEO/TEO',
                'created_by' => 'D'
            ],
            [
                'id' => '2',
                'name' => 'Submitted to School for feedback',
                'created_by' => 'D'
            ],
            [
                'id' => '3',
                'name' => 'Submitted to DEO after review by School',
                'created_by' => 'D'
            ],
            [
                'id' => '4',
                'name' => 'Submitted to EMD',
                'created_by' => 'D'
            ],
            [
                'id' => '5',
                'name' => 'Finalized and Closed',
                'created_by' => 'D'
            ],
        ]);
    }
}
