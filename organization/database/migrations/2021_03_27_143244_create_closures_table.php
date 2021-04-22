<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClosuresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('closures', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('code');
            $table->string('name');
            $table->string('category');
            $table->char('level',36);
            $table->foreign('level')->references('id')->on('level');
            $table->string('dzongkhag');
            $table->string('gewog');
            $table->string('chiwog');
            $table->char('location',36);
            $table->foreign('location')->references('id')->on('location');
            $table->tinyInteger('geoPoliticallyLocated');
            $table->tinyInteger('senSchool');
            $table->string('reason');
            $table->string('remark')->nullable(true);
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
        Schema::dropIfExists('closures');
    }
}
