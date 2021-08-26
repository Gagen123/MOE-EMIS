<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SpmAgencyInputRevision extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spm_agency_input_revision', function (Blueprint $table) {
            $table->char('id',36)->primary();
            $table->char('agency_input_id',36)->index();
            $table->char('agency_input_obs_id',36)->index();
            $table->string('action_taken',500);
            $table->date('action_taken_date');
            $table->char('created_by',36);
            $table->timestamps();
            $table->foreign('agency_input_id')->references('id')->on('spm_agency_input');
            $table->foreign('agency_input_obs_id')->references('id')->on('spm_agency_input_observation');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spm_agency_input_revision');
    }
}
