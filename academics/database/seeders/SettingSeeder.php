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
        DB::statement("
            INSERT INTO `aca_setting` (`id`, `description`, `value`, `description_of_value`) VALUES
                (1, 'Assessment area format in result', '1', '1 - Code/abbreviation 2 - Name'),
                (2, 'In result, show upto postion', '3', 'The position depends on the value'),
                (3, 'Minimum attendance in percentage required for students', '90', '');
            ");
    }
}
