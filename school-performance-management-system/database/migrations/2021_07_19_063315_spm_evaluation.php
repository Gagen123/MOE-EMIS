<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SpmEvaluation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spm_evaluation', function (Blueprint $table) {
            $table->char('id',36)->primary();
            $table->char('org_id',36)->index();
            $table->char('spm_indicator_id',36)->index();
            $table->tinyInteger('score');
            $table->string('remarks',500);
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
        Schema::dropIfExists('spm_evaluation');
    }
}
