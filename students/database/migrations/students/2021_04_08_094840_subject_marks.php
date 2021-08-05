<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SubjectMarks extends Migration
{
    public function up(){
        Schema::create('subject_marks', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->varchar('streamId',36);
            $table->varchar('aca_sub_id',36)->nullable(true);
            $table->varchar('marks',36)->nullable(true);
            $table->char('updated_by',36)->nullable(true);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    public function down(){
        Schema::dropIfExists('subject_marks');
    }
}