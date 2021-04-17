<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AcaStudentAssessment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aca_student_assessment', function (Blueprint $table) {
            $table->char('id',36)->primary();
            $table->char('std_student_id',36)->index();
            $table->char('org_class_id',36)->index();
            $table->char('aca_sub_id',36)->index();
            $table->char('aca_assmt_area_id',36)->index();
            $table->char('aca_assmt_term_id',36)->index();
            $table->char('aca_rating_type_id',36)->index();
            $table->unsignedDecimal('score',5,2);
            $table->string('remarks',1000);
            $table->string('created_by',36)->index();
            $table->string('updated_by',36)->index()->nullable();
            $table->timestamps();

            $table->foreign('aca_sub_id')->references('id')->on('aca_class_subject');
            $table->foreign('aca_assmt_area_id')->references('id')->on('aca_assessment_area');
            $table->foreign('aca_assmt_term_id')->references('id')->on('aca_assessment_term');
            $table->foreign('aca_rating_type_id')->references('id')->on('aca_rating_type');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aca_student_assessment');
    }
}