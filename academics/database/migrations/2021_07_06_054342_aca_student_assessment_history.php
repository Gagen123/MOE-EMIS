<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AcaStudentAssessmentHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aca_std_assmnt_history', function (Blueprint $table) {
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
            $table->char('std_student_id',36)->index();
            $table->char('aca_assmt_area_id',36)->index();
            $table->char('aca_rating_type_id',36)->index();
            $table->unsignedDecimal('score',6,2)->nullable();
            $table->string('descriptive_score',255)->nullable();
            $table->string('remarks',1000)->nullable();
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
        Schema::dropIfExists('aca_std_assmnt_history');
    }
}
