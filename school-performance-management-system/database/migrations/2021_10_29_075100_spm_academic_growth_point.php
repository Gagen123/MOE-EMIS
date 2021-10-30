<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SpmAcademicGrowthPoint extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spm_academic_growth_point', function (Blueprint $table) {
            $table->unsignedTinyInteger('id', 36);
            $table->decimal('difference_from', 6, 2);
            $table->decimal('difference_to', 6, 2);
            $table->unsignedDecimal('points', 6, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spm_academic_growth_point');
    }
}
