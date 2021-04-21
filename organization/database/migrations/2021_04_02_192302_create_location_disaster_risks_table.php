<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationDisasterRisksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('location_disaster_risks', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('locationId',36);
            $table->foreign('locationId')->references('id')->on('locations');
            $table->char('disasterTypeId',36);
            $table->foreign('disasterTypeId')->references('id')->on('disaster');
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
        Schema::dropIfExists('location_disaster_risks');
    }
}
