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
            $table->char('parent_for',36)->nullable(true)->comment('use for bifurcation');
            $table->char('classId',36);
            $table->foreign('classId')->references('id')->on('classes');
            $table->char('streamId',36)->nullable(true);
            $table->foreign('streamId')->references('id')->on('streams');
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
