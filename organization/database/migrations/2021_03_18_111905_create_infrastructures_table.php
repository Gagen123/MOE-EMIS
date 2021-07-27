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
            $table->foreign('organizationId')->references('id')->on('organization_details');
            $table->char('categoryId',36);
            $table->foreign('categoryId')->references('id')->on('structure_category');
            $table->char('subCategoryId',36);
            $table->foreign('subCategoryId')->references('id')->on('structure_sub_categories');
            $table->integer('structureNo')->nullable(true);
            $table->string('yearofconstructinNos');
            $table->string('plintchArea')->nullable(true);
            $table->integer('noOfFloor')->nullable(true);
            $table->integer('totalCapacity')->nullable(true);
            $table->tinyInteger('rampAccess');
            $table->integer('presentCondition');
            $table->char('design',36)->nullable(true);
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
