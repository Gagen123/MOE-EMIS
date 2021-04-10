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
            $table->char('roadTypeId',36);
            $table->decimal('distanceFromRoad')->nullable(true);;
            $table->decimal('daysFromRoad')->nullable(true);;
            $table->decimal('hoursFromRoad')->nullable(true);;
            $table->char('electricitySourceId',36);
            $table->char('electricitySupplyId',36)->nullable(true);;
            $table->integer('hasElectricalSubstation');
            $table->char('telephoneServiceProvoderId',36);
            $table->char('internetServiceProviderId',36);
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
