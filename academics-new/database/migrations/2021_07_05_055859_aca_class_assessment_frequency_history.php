<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AcaClassAssessmentFrequencyHistory extends Migration
{
  /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
     Schema::create('aca_class_assmnt_frequency_history', function (Blueprint $table) {
        $table->char('id',36)->primary();
        $table->char('org_class_id',36)->index();
        $table->char('org_stream_id',36)->nullable()->index();
        $table->char('aca_assmt_frequency_id',36)->index();
        $table->unsignedTinyInteger('aca_assmnt_type')->index()->default(1)->comment('0 - NA ,1 - subjects as rows, 2 - subjects as columns');
        $table->string('class_stream',100);
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
        Schema::dropIfExists('aca_class_assmnt_frequency_history');
    }
}
