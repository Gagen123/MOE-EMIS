<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AcaResultStudent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aca_result_student', function (Blueprint $table) {
            $table->char('id', 36);
            $table->smallInteger('academic_year');
            $table->char('aca_result_id', 36)->index();
            $table->char('std_student_id', 36)->index();
            $table->string('student_code', 100);
            $table->string('name', 100);
            $table->string('cid', 50)->index()->nullable();
            $table->char('admission_no', 36);
            $table->date('dob');
            $table->unsignedSmallInteger('roll_no');
            $table->unsignedDecimal('marks_percent', 6, 2);
            $table->unsignedSmallInteger('position');
            $table->unsignedSmallInteger('no_of_days_attended');
            $table->unsignedSmallInteger('instructional_days');
            $table->unsignedSmallInteger('attendance_percent');
            $table->string('special_award', 500)->nullable();
            $table->string('responsibility', 500)->nullable();
            $table->unsignedTinyInteger('promoted')->nullable()->comment('0-detained, 1-promoted');
            $table->string('general_comment', 500)->nullable();
            $table->char('created_by', 36)->nullable();
            $table->string('updated_by', 36)->nullable();
            $table->timestamps();

            $table->primary(['id', 'academic_year']);
        });

        DB::statement(
            "ALTER TABLE aca_result_student PARTITION BY RANGE(academic_year)(
            PARTITION before_year_2022 VALUES LESS THAN (2022),
            PARTITION year_2022 VALUES LESS THAN (2023),
            PARTITION year_2023 VALUES LESS THAN (2024),
            PARTITION year_2024 VALUES LESS THAN (2025),
            PARTITION year_2025 VALUES LESS THAN (2026),
            PARTITION after_year_2025 VALUES LESS THAN MAXVALUE)"
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aca_result_student');
    }
}
