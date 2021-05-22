<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StudentScholarType extends Migration
{
    public function up(){
        Schema::create('master_student_scholar', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->tinyinteger('status');
            $table->char('created_by',36)->nullable(true);
            $table->char('updated_by',36)->nullable(true);
            $table->timestamps();
        });
    }

    public function down(){
        Schema::dropIfExists('master_student_scholar');
    }
}
