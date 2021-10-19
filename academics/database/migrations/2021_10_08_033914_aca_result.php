<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AcaResult extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aca_result', function (Blueprint $table) {
            $table->char('id', 36);
            $table->char('aca_result_consolidated_id', 36)->index();
            $table->smallInteger('academic_year')->index();
            $table->unsignedTinyInteger('transcript_format')->index()->default(1)->comment('0 - NA ,1 - key stage I ( CFA -subjects as rows), 2 - key stage II-V (CSA- subjects as columns)');
            $table->unsignedTinyInteger('term_number');
            $table->string('term_name', 50);
            $table->char('org_id', 36)->index();
            $table->string('school_name', 50);
            $table->unsignedSmallInteger('gewog_id')->index();
            $table->string('gewog', 50);
            $table->unsignedSmallInteger('dzon_id')->index();
            $table->string('dzongkhag', 50);
            $table->char('org_class_id', 36)->index();
            $table->string('class', 255);
            $table->char('org_stream_id', 36)->nullable()->index();
            $table->string('stream', 255)->nullable();
            $table->char('org_section_id', 36)->nullable()->index();
            $table->string('section', 255)->nullable();
            $table->char('stf_class_teacher_id', 36)->index();
            $table->string('stf_class_tecaher_name', 100);
            $table->char('stf_principal_id', 36)->index();
            $table->string('stf_principal_name', 100);
            $table->char('created_by', 36)->nullable();
            $table->string('updated_by', 36)->nullable();
            $table->timestamps();

            $table->primary(['id', 'academic_year']);
        });

        DB::statement(
            "ALTER TABLE aca_result PARTITION BY RANGE(academic_year)(
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
        Schema::dropIfExists('aca_result');
    }
}
