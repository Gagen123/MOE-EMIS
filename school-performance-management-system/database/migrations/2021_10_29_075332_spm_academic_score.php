<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SpmAcademicScore extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spm_academic_score', function (Blueprint $table) {
            $table->char('id', 36)->primary();
            $table->char('spm_evaluation_id', 36)->index();
            $table->char('spm_indicator_id', 36)->index();
            $table->decimal('parameter_1', 6, 2)->nullable();
            $table->decimal('parameter_2', 6, 2)->nullable();
            $table->string('operator', 20);
            $table->string('formula', 100);
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
        Schema::dropIfExists('spm_academic_score');
    }
}
