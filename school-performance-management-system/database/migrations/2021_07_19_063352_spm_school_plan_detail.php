<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SpmSchoolPlanDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spm_school_plan_detail', function (Blueprint $table) {
            $table->char('id',36)->primary();
            $table->char('spm_school_plan_id',36)->index();
            $table->char('spm_domain_id',36)->index()->nullable();
            $table->string('activity',255);
            $table->string('objective',255);
            $table->string('strategy',255);
            $table->date('start_date')->index();
            $table->date('end_date')->index();
            $table->string('person_responsible',255);
            $table->string('status',100);
            $table->string('remarks',500);
            $table->char('created_by',36);
            $table->timestamps();

        });
    }

    /*
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spm_school_plan_detail');
    }
}
