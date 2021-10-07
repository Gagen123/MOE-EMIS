<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AcaYearlyResultScore extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aca_yearly_result_score', function (Blueprint $table) {
            $table->char('id',36)->primary();
            $table->char('aca_yearly_result_student_id',36)->index();
            $table->char('std_student_id',36)->index();
            $table->string('name',50);
            $table->string('cid',50);
            $table->char('admission_no',36);
            $table->date('dob',36);
            $table->unsignedSmallInteger('roll_no')->index();
            $table->unsignedSmallInteger('promoted/detained')->comment(' 0-detained,1-promoted');
            $table->string('subject',200);
            $table->string('assmnt_area',100);
            $table->tinyInteger('score');
            $table->string('descriptive_score',100)->nullable();
            $table->char('created_by',36)->nullable()->index();
            $table->string('updated_by',36)->index()->nullable();
            $table->timestamps();

            $table->foreign('aca_yearly_result_student_id')->references('id')->on('aca_yearly_result_student')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aca_yearly_result_score');
    }
}
