<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHeadQuaterDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('head_quater_details', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->tinyInteger('organizationId');
            $table->string('zestAgencyCode');
            $table->string('agencyName');
            $table->tinyInteger('organizationType');
            $table->tinyInteger('chiwogId');
            $table->tinyInteger('dzongkhagId');
            $table->tinyInteger('gewogId');
            $table->string('status');
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
        Schema::dropIfExists('head_quater_details');
    }
}
