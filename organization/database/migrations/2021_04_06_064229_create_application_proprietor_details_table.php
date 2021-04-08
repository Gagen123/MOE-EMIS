<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationProprietorDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('application_proprietor_details', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('applicationId',36);
            $table->integer('cid');
            $table->string('fullName');
            $table->integer('phoneNo');
            $table->string('email');
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
        Schema::dropIfExists('application_proprietor_details');
    }
}
