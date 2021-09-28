<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImplementationStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('spm_implementation_status')->insert([
            [
                'id' => '0',
                'name' => 'Not Started',
                'created_by' => 'D'
            ],
            [
                'id' => '1',
                'name' => 'In Progress',
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
