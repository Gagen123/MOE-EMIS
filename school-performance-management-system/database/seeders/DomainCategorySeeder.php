<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DomainCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('spm_domain_category')->insert([
            [
                'id' => '0',
                'name' => 'Non-Academic',
                'created_by' => 'D'
            ],
            [
                'id' => '1',
                'name' => 'Academic',
                'created_by' => 'D'
            ],
        ]);
    }
}
