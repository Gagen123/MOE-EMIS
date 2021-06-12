<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Database\Seeders\SettingSeeder;

class AcaSetting extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aca_setting', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('description',100);
            $table->string('value',100);
            $table->string('description_of_value',200);
<<<<<<< HEAD
          
=======
>>>>>>> 76adf1671904dd9bfd47960df1f61a7ef856021c
        });
        $seeder = new SettingSeeder();
        $seeder->run();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aca_setting');
    }
}
