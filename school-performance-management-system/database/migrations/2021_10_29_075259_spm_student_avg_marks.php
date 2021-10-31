<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SpmStudentAvgMarks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spm_student_avg_marks', function (Blueprint $table) {
            $table->char('id', 36)->primary();
            $table->char('spm_evaluation_id', 36)->index();
            $table->string('name', 100);
            $table->string('cid', 50)->nullable();
            $table->string('index_no', 255);
            $table->string('std_student_code', 255)->index();
            $table->unsignedDecimal('marks', 6, 2);
            $table->timestamps();

            $table->foreign('spm_evaluation_id')->references('id')->on('spm_evaluation')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spm_student_avg_marks');
    }
}
