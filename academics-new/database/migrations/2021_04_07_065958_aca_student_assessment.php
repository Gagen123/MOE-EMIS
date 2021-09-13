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
            $table->char('org_id',36)->index();
            $table->char('org_class_id',36)->index();
            $table->char('org_stream_id',36)->index()->nullable();
            $table->char('org_section_id',36)->index()->nullable();
            $table->char('aca_sub_id',36)->index();
            $table->char('aca_assmt_term_id',36)->index();
            $table->string('class_stream_section',100);
            $table->date('finalized_date')->nullable();
            $table->unsignedTinyInteger('finalized')->default(0)->index();
            $table->string('created_by',36)->index();
            $table->string('updated_by',36)->index()->nullable();
            $table->timestamps();

            $table->foreign('aca_sub_id')->references('id')->on('aca_subject');
            $table->foreign('aca_assmt_term_id')->references('id')->on('aca_assessment_term');

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
