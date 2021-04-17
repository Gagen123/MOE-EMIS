<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AcaAssessmentTerm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aca_assessment_term', function (Blueprint $table) {
            $table->char('id',36)->primary();
            $table->char('aca_assmt_frequency_id',36)->index();
            $table->string('name',100)->unique();
            $table->unsignedTinyInteger('display_order')->index();
            $table->unsignedTinyInteger('status')->index()->default(1)->comment('0 - Disabled');
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
        Schema::dropIfExists('aca_assessment_term');
    }
}
