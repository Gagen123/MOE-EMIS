<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AcaStudentAttendanceDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aca_student_attendance_detail', function (Blueprint $table) {
            $table->char('id',36)->primary();
            $table->char('aca_std_attendance_id',36)->index();
            $table->char('std_student_id',36)->index();
            $table->unsignedTinyInteger('is_present')->index()->default(1)->comment('0 - Absent, 1 - Present');
            $table->string('created_by',36)->index();
            $table->string('updated_by',36)->index()->nullable();
            $table->timestamps();

            $table->foreign('aca_std_attendance_id')->references('id')->on('aca_student_attendance')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aca_student_attendance_detail');
    }
}
