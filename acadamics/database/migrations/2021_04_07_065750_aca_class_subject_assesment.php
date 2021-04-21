<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AcaClassSubjectAssesment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aca_class_subject_assessment', function (Blueprint $table) {
            $table->char('id',36)->primary();
            $table->char('org_class_id',36)->index();
            $table->char('aca_sub_id',36)->index();
            $table->char('aca_assmt_term_id',36)->index();
            $table->char('aca_assmt_area_id',36)->index();
            $table->decimal('weightage',5,2)->nullable()->comment('Not Null, if rating type is marks (summative)');
            $table->unsignedTinyInteger('display_order')->index();
            $table->string('created_by',36)->index();
            $table->string('updated_by',36)->index()->nullable();
            $table->timestamps();


            $table->unique(['org_class_id', 'aca_sub_id', 'aca_assmt_term_id', 'aca_assmt_area_id'],'unique_class_sub_term_area');

            $table->foreign('aca_sub_id')->references('id')->on('aca_subject')->onDelete('cascade');
            $table->foreign('aca_assmt_area_id')->references('id')->on('aca_assessment_area');
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
        Schema::dropIfExists('aca_class_subjectassessment');
    }
}
