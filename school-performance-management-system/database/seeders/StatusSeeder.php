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
                'name' => 'Draft',
                'created_by' => 'D'
            ],
            [
                'id' => '2',
                'name' => 'Completed',
                'created_by' => 'D'
            ],
        ]);
    }
}
