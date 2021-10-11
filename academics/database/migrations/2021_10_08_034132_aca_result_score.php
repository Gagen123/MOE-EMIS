<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AcaResultScore extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aca_result_score', function (Blueprint $table) {
            $table->char('id',36);
            $table->smallInteger('academic_year');
            $table->char('aca_result_student_id',36)->index();
            $table->char('aca_result_subject_id',36)->index();
            $table->char('aca_assmnt_id',36)->index();
            $table->string('assessment_area',100);
            $table->tinyInteger('score')->nullable()->default(null);
            $table->string('score_description',500)->nullable()->default(null);
            $table->unsignedTinyInteger('passed',36)->index()->comment('0-failed, 1-passed');
            $table->integer('display_order');
            $table->char('created_by',36)->nullable()->index();
            $table->string('updated_by',36)->index()->nullable();
            $table->timestamps();

            $table->primary(['id','academic_year']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aca_result_score');
    }
}
