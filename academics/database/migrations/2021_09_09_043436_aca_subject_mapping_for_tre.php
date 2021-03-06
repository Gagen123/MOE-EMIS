<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AcaSubjectMappingForTre extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aca_subject_mapping_for_tre', function (Blueprint $table) {
            $table->char('id',36)->primary();
            $table->char('org_class_id',36)->index();
            $table->char('org_stream_id',36)->index()->nullable();
            $table->char('aca_sub_id',36)->index();
            $table->char('aca_teacher_sub_id',36)->index();
            $table->string('class_stream',100);
            $table->smallInteger('standard_hours');
            $table->smallInteger('standard_minutes');
            $table->string('created_by',36)->index()->nullable();
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
        Schema::dropIfExists('aca_subject_mapping_for_tre');
    }
}
