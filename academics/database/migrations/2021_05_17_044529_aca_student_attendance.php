<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AcaStudentAttendance extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('aca_student_attendance', function (Blueprint $table) {
            $table->char('id',36)->primary();
            $table->char('org_id',36)->index();
            $table->char('org_class_id',36)->index();
            $table->char('org_stream_id',36)->index()->nullable();
            $table->char('org_section_id',36)->index()->nullable();
            $table->string('class_stream_section',100);
            $table->date('attendance_date')->unique();
            $table->string('created_by',36)->index();
            $table->string('updated_by',36)->index()->nullable();
            $table->timestamps();

            $table->unique(['org_class_id', 'org_stream_id','org_section_id','attendance_date'],'unique_class_stream_attendance_date');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aca_student_attendance');
    }
}
