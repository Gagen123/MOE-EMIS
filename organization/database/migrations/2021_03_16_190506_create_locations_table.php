<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('organizationId',36);
            $table->foreign('organizationId')->references('id')->on('organization_details');
            $table->integer('landOwnership');
            $table->integer('compoundFencing');
            $table->integer('entranceGate');
            $table->decimal('longitude')->nullable(true);
            $table->decimal('latitude')->nullable(true);
            $table->decimal('altitude')->nullable(true);
            $table->string('thramNo');
            $table->string('cid')->nullable(true);
            $table->string('name')->nullable(true);
            $table->string('compoundArea');
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
        Schema::dropIfExists('locations');
    }
}
