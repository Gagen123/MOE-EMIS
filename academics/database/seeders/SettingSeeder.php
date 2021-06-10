<?php

namespace Database\Seeders;

<<<<<<< HEAD
=======
use Carbon\Carbon;
>>>>>>> 93527b4b5829b875cdf6612a182d5333b02a60fd
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
        ]);
    }
}
