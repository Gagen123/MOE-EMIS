<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStructureSubCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('structure_sub_categories', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('structureCategory',36);
            $table->foreign('structureCategory')->references('id')->on('structure_category');
            $table->string('subCategoryName');
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
        Schema::dropIfExists('structure_sub_categories');
    }
}
