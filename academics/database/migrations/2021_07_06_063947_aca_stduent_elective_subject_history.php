<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AcaStduentElectiveSubjectHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aca_std_optional_sub_history', function (Blueprint $table) {
            $table->char('id',36)->primary();
            $table->char('std_student_id',36)->index();
            $table->char('aca_sub_id',36)->index();
            $table->string('recorded_for',100);
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
        Schema::dropIfExists('aca_std_optional_sub_history');
    }
}

 