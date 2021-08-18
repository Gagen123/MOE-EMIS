<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SpmSchoolPlanHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spm_school_plan_history', function (Blueprint $table) {
            $table->char('id',36)->primary();
            $table->char('user_id',36)->index();
            $table->string('name',255);
            $table->string('role',100);
            $table->string('organization',255);
            $table->string('status',100);
            $table->date('status_date')->index();
            $table->string('remarks',500);
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
        Schema::dropIfExists('spm_school_plan_history');
    }
}
