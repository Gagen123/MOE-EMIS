<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AcaClassSubjectAssessmentHistory extends Migration
{
     /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aca_class_sub_assmnt_history', function (Blueprint $table) {
            $table->char('id',36)->primary();
            $table->char('org_class_id',36)->index();
            $table->char('org_stream_id',36)->nullable()->index();
            $table->char('aca_sub_id',36)->index();
            $table->char('aca_assmt_term_id',36)->index();
            $table->char('aca_assmt_area_id',36)->index();
            $table->string('class_stream',100);
            $table->decimal('weightage',5,2)->nullable()->comment('Not Null, if rating type is marks (summative)');
            $table->unsignedTinyInteger('display_order')->index();
            $table->string('recorded_for',100);
            $table->string('created_by',36)->index();
            $table->string('updated_by',36)->index()->nullable();
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
        Schema::dropIfExists('aca_class_subjectassessment');
    }
}
