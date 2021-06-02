<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AcaClassAssessmentFrequency extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
     Schema::create('aca_class_assessment_frequency', function (Blueprint $table) {
        $table->char('id',36)->primary();
        $table->char('org_class_id',36)->index();
        $table->char('org_stream_id',36)->nullable()->index();
        $table->char('aca_assmt_frequency_id',36)->index();
        $table->string('class_stream',100);
        $table->string('created_by',36)->index();
        $table->string('updated_by',36)->index()->nullable();
        $table->timestamps();
        
        $table->foreign('aca_assmt_frequency_id')->references('id')->on('aca_assessment_frequency');

     });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aca_classassessment_frequency');
    }
}
