<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SpmSubjectAvgMarks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spm_subject_avg_marks', function (Blueprint $table) {
            $table->char('id', 36)->primary();
            $table->char('aca_sub_id', 36)->index();
            $table->unsignedDecimal('marks', 6, 2);
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
        Schema::dropIfExists('spm_subject_avg_marks');
    }
}
