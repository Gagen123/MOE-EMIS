<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodReleasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('food_releases', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->date('dateOfrelease')->nullable(false);
            $table->char('dzongkhag_id',36)->nullable(false);
            $table->char('org_id',36)->nullable(false);
            $table->char('term_id',36)->nullable(false);
            $table->string('remarks')->nullable(true);
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
        Schema::dropIfExists('food_releases');
    }
}
