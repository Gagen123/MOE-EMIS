<?php

namespace Database\Seeders;

<<<<<<< HEAD
=======
use Carbon\Carbon;
>>>>>>> 9454f15876d78d0f74165d906256bcd1ca96d21b
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
