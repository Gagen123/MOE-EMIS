<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AcaStudentAttendanceHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aca_std_attendance_history', function (Blueprint $table) {
            $table->char('id',36)->primary();
            $table->char('org_id',36)->index();
            $table->char('org_class_id',36)->index();
            $table->char('org_stream_id',36)->index()->nullable();
            $table->char('org_section_id',36)->index()->nullable();
            $table->string('class_stream_section',100);
            $table->date('attendance_date')->index();
            $table->char('std_student_id',36)->index();
            $table->char('aca_absence_reason_id',36)->nullable();
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
        Schema::dropIfExists('aca_std_attendance_history');
    }
}
