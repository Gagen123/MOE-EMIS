<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AcaSchoolElectiveSubject extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aca_school_elective_subject', function (Blueprint $table) {
            $table->char('id',36)->primary();
            $table->char('org_id',36)->index();
            $table->char('org_class_id',36)->index();
            $table->char('org_stream_id',36)->nullable()->index();
            $table->char('org_section_id',36)->nullable()->index();
            $table->char('aca_sub_id',36)->index();
            $table->string('class_stream_section',100);
            $table->string('created_by',36)->index();
            $table->string('updated_by',36)->index()->nullable();
            $table->timestamps();

            $table->foreign('aca_sub_id')->references('id')->on('aca_subject');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aca_school_elective_subject');
    }
}
