<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AcaInstructionalDaysSpecialCase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('aca_instructional_days_special_case', function (Blueprint $table) {
            $table->char('id',36)->primary();
            $table->char('org_id',36)->index();
            $table->char('org_class_id',36)->index();
            $table->char('org_stream_id',36)->index();
            $table->char('org_section_id',36)->index();
            $table->char('std_student_id',36)->index();
            $table->char('aca_term_id',36)->index();
            $table->integer('instructional_days')->index();
            $table->string('remarks');
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
        Schema::dropIfExists('aca_instructional_days_special_case');
    }
}
