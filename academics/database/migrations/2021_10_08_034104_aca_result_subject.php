<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AcaResultSubject extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aca_result_subject', function (Blueprint $table) {
            $table->char('id',36);
            $table->smallInteger('academic_year');
            $table->char('aca_result_id',36)->index();
            $table->char('aca_sub_id',36)->index();
            $table->string('subject',200);
            $table->unsignedTinyInteger('is_academic')->index()->default(1);
            $table->char('teacher_id',36)->index();
            $table->string('teacher',200);
            $table->unsignedTinyInteger('show_in_result')->index()->default(1);
            $table->integer('display_order')->index();
            $table->char('created_by',36)->nullable()->index();
            $table->string('updated_by',36)->index()->nullable();
            $table->timestamps();

            $table->primary(['id','academic_year']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aca_result_subject');
    }
}
