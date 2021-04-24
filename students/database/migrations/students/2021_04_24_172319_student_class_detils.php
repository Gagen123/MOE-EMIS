<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StudentClassDetils extends Migration
{
    public function up(){
        Schema::create('std_class_detils', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('student_id',36)->nullable(false);
            $table->char('class_stream_id',36)->nullable(false);
            $table->char('section',36)->nullable(false);
            $table->string('student_type')->nullable(false);
            $table->string('no_meals');
            $table->string('scholarship')->nullable();
            $table->string('special_benifit')->nullable();
            $table->char('disability',36)->nullable(false);
            $table->char('created_by',36)->nullable(true);
            $table->char('updated_by',36)->nullable(true);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    public function down(){
        Schema::dropIfExists('std_class_detils');
    }
}
