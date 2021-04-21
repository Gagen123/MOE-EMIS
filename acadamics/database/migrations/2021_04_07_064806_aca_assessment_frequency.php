<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AcaAssessmentFrequency extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aca_assessment_frequency', function (Blueprint $table) {
            $table->char('id',36)->primary();
            $table->string('name',100)->unique();
            $table->unsignedTinyInteger('status')->index()->default(1)->comment('0 - Disabled');
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
        Schema::dropIfExists('aca_assessment_frequency');
    }
}
