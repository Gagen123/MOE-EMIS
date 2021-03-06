<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStructureFacilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infrastructure_facilities', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('infrastructureId',36);
            $table->foreign('infrastructureId')->references('id')->on('infrastructures');
            $table->char('facilityTypeId',36);
            $table->foreign('facilityTypeId')->references('id')->on('structure_facility');
            $table->string('facilityName');
            $table->string('capacity');
            $table->integer('noOfFacility');
            $table->integer('noAccessibleToDisabled');
            $table->integer('noWithInternetConnection');
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
        Schema::dropIfExists('structure_facilities');
    }
}
