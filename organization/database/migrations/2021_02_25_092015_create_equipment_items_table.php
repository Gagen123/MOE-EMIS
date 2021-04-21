<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipmentItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipment_items', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('equipmentItem');
            $table->char('equipmentType',36);
            $table->foreign('equipmentType')->references('id')->on('equipment_type');
            $table->string('description')->nullable(true);
            $table->tinyInteger('status');
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
        Schema::dropIfExists('equipment_items');
    }
}
