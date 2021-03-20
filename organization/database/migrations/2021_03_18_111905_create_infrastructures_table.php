<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfrastructuresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infrastructures', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('organizationId',36);
            $table->char('categoryId',36);
            $table->char('subCategoryId',36);
            $table->integer('structureNo');
            $table->integer('yearOfConstruction');
            $table->string('plintchArea');
            $table->integer('noOfFloor');
            $table->integer('totalCapacity');
            $table->tinyInteger('rampAccess');
            $table->integer('presentCondition');
            $table->integer('design');
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
        Schema::dropIfExists('infrastructures');
    }
}
