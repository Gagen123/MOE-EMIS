<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AcaTeacherSubject extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aca_teacher_subject', function (Blueprint $table) {
            $table->char('id', 36)->primary();
            $table->string('name', 100)->index();
            $table->string('code', 10)->index();
            $table->unsignedTinyInteger('is_special_educational_needs')->index()->default(0);
            $table->unsignedTinyInteger('status')->index()->default(1)->comment('0-Disabled');
            $table->string('created_by', 36)->index()->nullable();
            $table->string('updated_by', 36)->index()->nullable();
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
        Schema::dropIfExists('aca_teacher_subject');
    }
}
