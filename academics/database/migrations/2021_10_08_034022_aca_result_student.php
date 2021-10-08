<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
            $table->char('id',36);
            $table->smallInteger('academic_year');
            $table->char('aca_result_id',36)->index();
            $table->char('std_student_id',36)->index();
            $table->string('student_code',100);
            $table->string('name',100);
            $table->string('cid',50)->index()->nullable();
            $table->char('admission_no',36);
            $table->date('dob');
            $table->string('score_description',500)->nullable()->default(null);
            $table->unsignedSmallInteger('roll_no',36);
            $table->string('special_award',500)->nullable();
            $table->string('responsibility',500)->nullable();
            $table->unsignedTinyInteger('promoted')->comment('0-detained, 1-promoted');
            $table->string('general_comment',500)->nullable();
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
        Schema::dropIfExists('aca_result_student');
    }
}
