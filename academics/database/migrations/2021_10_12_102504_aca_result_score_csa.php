<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AcaResultScoreCsa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aca_result_score_csa', function (Blueprint $table) {
            $table->char('id', 36);
            $table->smallInteger('academic_year');
            $table->char('aca_result_student_id', 36)->index();
            $table->char('aca_rating_type_id', 36)->index();
            $table->string('sub_category_code', 10);
            $table->string('subject', 100);
            $table->string('sub_dzo_name', 100)->nullable();
            $table->string('assessment_area', 100)->nullable();
            $table->string('assmnt_area_dzo_name', 1000)->nullable();
            $table->unsignedDecimal('ca_score', 6, 2)->nullable();
            $table->unsignedDecimal('exam_score', 6, 2)->nullable();
            $table->unsignedDecimal('t1_ca_score', 6, 2)->nullable();
            $table->unsignedDecimal('t1_exam_score', 6, 2)->nullable();
            $table->unsignedDecimal('t2_ca_score', 6, 2)->nullable();
            $table->unsignedDecimal('t2_exam_score', 6, 2)->nullable();
            $table->tinyInteger('score')->nullable();
            $table->string('score_description', 500)->nullable();
            $table->string('score_descr_dzo_name', 500)->nullable();
            $table->integer('display_order');
            $table->char('created_by', 36)->nullable();
            $table->string('updated_by', 36)->nullable();
            $table->timestamps();

            $table->primary(['id', 'academic_year']);
        });
        DB::statement(
            "ALTER TABLE aca_result_score_csa PARTITION BY RANGE(academic_year)(
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
        Schema::dropIfExists('aca_result_score_csa');
    }
}
