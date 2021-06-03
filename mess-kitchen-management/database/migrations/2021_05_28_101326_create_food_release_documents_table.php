<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodReleaseDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('food_release_documents', function (Blueprint $table) {
            $table->char('id',36)->unique()->primary();
            $table->char('foodreleaseId',36)->nullable(false);
            $table->string('attachment_for',200)->nullable(true);
            $table->string('path',200)->nullable(false);
            $table->string('original_name',200)->nullable(false);
            $table->string('user_defined_name',200)->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('food_release_documents');
    }
}
