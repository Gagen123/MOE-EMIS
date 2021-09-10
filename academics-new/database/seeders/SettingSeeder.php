<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('aca_setting')->insert([
            [
                'id' => '1',
                'description' => 'Assessment area format in result',
                'value'=>'1',
                'description_of_value' => '1 - Code/abbreviation 2 - Name',
            ],
            [
                'id' => '2',
                'description' => 'In result, show upto postion',
                'value'=>'3',
                'description_of_value' => 'The position depends on the value',
            ],
        ]);
    }
}
