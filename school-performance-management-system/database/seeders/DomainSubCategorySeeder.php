<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DomainSubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('spm_domain_sub_category')->insert([
            [
                'id' => '1',
                'spm_domain_category_id' => '0',
                'org_class_id' => null,
                'name' => 'Non-Academic',
                'created_by' => 'D'
            ],
            [
                'id' => '2',
                'spm_domain_category_id' => '1',
                'org_class_id' => '0f150274-91e4-4fc1-906e-79bd1b3a1734',
                'name' => 'Academic (Class VI)',
                'created_by' => 'D'
            ],
            [
                'id' => '3',
                'spm_domain_category_id' => '1',
                'org_class_id' => 'efc535b3-dda4-4dba-8f4f-6e0fc01556c1',
                'name' => 'Academic (Class X)',
                'created_by' => 'D'
            ],
            [
                'id' => '4',
                'spm_domain_category_id' => '1',
                'org_class_id' => 'dbdc53f4-0185-4fdc-8092-43798cc1de70',
                'name' => 'Academic (Class XII)',
                'created_by' => 'D'
            ],
          
        ]);
    }
}
