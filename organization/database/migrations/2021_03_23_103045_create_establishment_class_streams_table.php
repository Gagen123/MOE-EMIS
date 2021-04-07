<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstablishmentClassStreamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('application_class_streams', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('applicationNo');
            $table->char('classId',36);
            $table->char('streamId',36)->nullable(true);
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
        Schema::dropIfExists('establishment_class_streams');
    }
}
