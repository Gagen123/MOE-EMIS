<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConnectivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('connectivities', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('organizationId',36);
            $table->foreign('organizationId')->references('id')->on('organization_details');
            $table->char('roadTypeId',36);
            $table->foreign('roadTypeId')->references('id')->on('road_types');
            $table->decimal('distanceFromRoad')->nullable(true);;
            $table->decimal('daysFromRoad')->nullable(true);;
            $table->decimal('hoursFromRoad')->nullable(true);;
            $table->char('electricitySourceId',36);
            $table->foreign('electricitySourceId')->references('id')->on('electricity_sources');
            $table->char('electricitySupplyId',36)->nullable(true);
            $table->foreign('electricitySupplyId')->references('id')->on('electricity_supplies');
            $table->integer('hasElectricalSubstation');
            $table->char('telephoneServiceProvoderId',36);
            $table->foreign('telephoneServiceProvoderId')->references('id')->on('service_providers');
            $table->char('internetServiceProviderId',36);
            $table->foreign('internetServiceProviderId')->references('id')->on('service_providers');
            $table->char('mbps')->nullable(true);;
            $table->integer('drukRenConnection');
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
        Schema::dropIfExists('connectivities');
    }
}
