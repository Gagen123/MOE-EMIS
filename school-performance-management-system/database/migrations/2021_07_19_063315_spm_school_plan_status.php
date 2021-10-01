<?php

use Database\Seeders\SchoolPlanStatusSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SpmSchoolPlanStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spm_school_plan_status', function (Blueprint $table) {
            $table->unsignedTinyInteger('id')->primary();
            $table->string('name',500);
            $table->char('created_by',36);
            $table->timestamps();
        });
        $seeder = new SchoolPlanStatusSeeder();
        $seeder->run();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spm_school_plan_status');
    }
}
