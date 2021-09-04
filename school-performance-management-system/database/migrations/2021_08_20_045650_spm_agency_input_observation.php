<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SpmAgencyInputObservation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spm_agency_input_observation', function (Blueprint $table) {
            $table->char('id',36)->primary();
            $table->char('agency_input_id',36)->index();
            $table->char('dzon_id',36)->index();
            $table->char('org_id',36)->index()->comment('schoolId');
            $table->string('observation',1000);
            $table->string('recommendation',1000);
            $table->date('recommendation_date',1000);
            $table->char('created_by',36);
            $table->timestamps();

            $table->foreign('agency_input_id')->references('id')->on('spm_agency_input');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spm_agency_input_observation');
    }
}
