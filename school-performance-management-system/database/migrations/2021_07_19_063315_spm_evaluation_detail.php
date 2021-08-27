<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SpmEvaluationDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spm_evaluation_detail', function (Blueprint $table) {
            $table->char('id',36)->primary();
            $table->char('spm_indicator_id',36)->index();
            $table->char('spm_evaluation_id',36)->index();
            $table->tinyInteger('score')->nullable();
            $table->string('remarks',500)->nullable();
            $table->char('created_by',36);
            $table->timestamps();
            
            $table->foreign('spm_indicator_id')->references('id')->on('spm_indicator');
            $table->foreign('spm_evaluation_id')->references('id')->on('spm_evaluation')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spm_evaluation_detail');
    }
}
