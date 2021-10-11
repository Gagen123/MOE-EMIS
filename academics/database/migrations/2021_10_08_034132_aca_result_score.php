<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AcaResultScore extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aca_result_score', function (Blueprint $table) {
            $table->char('id', 36);
            $table->smallInteger('academic_year');
            $table->char('aca_result_student_id', 36)->index();
            $table->char('aca_result_subject_id', 36)->index();
            $table->char('aca_assmt_area_id', 36)->index();
            $table->string('assessment_area', 100);
            $table->unsignedTinyInteger('aca_assmnt_type')->index()->comment('0 - Continuous Assessment, 1 - Term Examination');
            $table->tinyInteger('score')->nullable()->default(null);
            $table->string('score_description', 500)->nullable()->default(null);
            $table->unsignedTinyInteger('passed')->index()->comment('0-failed, 1-passed');
            $table->integer('display_order');
            $table->char('created_by', 36)->nullable()->index();
            $table->string('updated_by', 36)->index()->nullable();
            $table->timestamps();

            $table->primary(['id', 'academic_year']);
        });
        DB::statement(
            "ALTER TABLE aca_result_score PARTITION BY RANGE(academic_year)(
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
        Schema::dropIfExists('aca_result_score');
    }
}
