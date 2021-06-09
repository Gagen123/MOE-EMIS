<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sports', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('organizationId',36);
            $table->foreign('organizationId')->references('id')->on('organization_details');
            $table->char('facility',36);
            $table->foreign('facility')->references('id')->on('sport_facility_type');
            $table->char('type',36);
            $table->foreign('type')->references('id')->on('sport_facility_subtypes');
            $table->integer('yearOfEstablishment');
            $table->char('supportedBy',36);
            $table->foreign('supportedBy')->references('id')->on('sport_supporter');
            // $table->char('size');
            // $table->integer('courts');
            $table->tinyInteger('status');
            $table->integer('noOfFacility');
            $table->integer('rampAccess');
            $table->char('accessible');
            $table->char('created_by',36)->nullable(true);
            $table->char('updated_by',36)->nullable(true);
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
        Schema::dropIfExists('sports');
    }
}
