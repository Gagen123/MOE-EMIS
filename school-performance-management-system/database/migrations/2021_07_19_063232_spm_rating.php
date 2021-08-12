<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SpmRating extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spm_rating', function (Blueprint $table) {
            $table->char('id',36)->primary();
            $table->char('spm_indicator_id',36)->index();
            $table->tinyInteger('score');
            $table->string('description',500);
            $table->unsignedTinyInteger('status')->index();
            $table->char('created_by',36);
            $table->timestamps();

            $table->foreign('spm_indicator_id')->references('id')->on('spm_indicator');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spm_rating');
    }
}
