<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SpmSchoolPlan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spm_school_plan', function (Blueprint $table) {
            $table->char('id',36)->primary();
            $table->tinyInteger('dzon_id')->index();
            $table->char('org_id',36);
            $table->char('spm_domain_id',36)->index()->nullable();
            $table->year('year');
            $table->string('activity',255);
            $table->string('objective',255);
            $table->string('strategy',255);
            $table->date('start_date')->index();
            $table->date('end_date')->index();
            $table->string('person_responsible',255);
            $table->integer('implementation_status_id')->index();
            $table->unsignedTinyInteger('school_plan_status')->nullable();
            $table->string('remarks',500);
            $table->char('created_by',36);
            $table->timestamps();

            $table->foreign('implementation_status_id')->references('id')->on('spm_school_plan_status');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spm_school_plan');
    }
}
