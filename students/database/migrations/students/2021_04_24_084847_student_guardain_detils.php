<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StudentGuardainDetils extends Migration
{
    public function up(){
        Schema::create('std_guardain_detils', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('student_id',36)->nullable(false);
            $table->char('contact_type',36)->nullable(false);
            $table->char('nationality',36)->nullable(false);
            $table->char('cid_passport',60)->nullable(false);
            $table->string('name');
            $table->char('village_id',36)->nullable();
            $table->string('address')->nullable();
            $table->char('present_village_id',36)->nullable(false);
            $table->string('work_address')->nullable(false);
            $table->string('residence_address')->nullable();
            $table->char('occupation',36)->nullable();
            $table->string('email')->nullable();
            $table->string('cntct_no')->nullable();
            $table->char('created_by',36)->nullable(true);
            $table->char('updated_by',36)->nullable(true);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    public function down(){
        Schema::dropIfExists('std_guardain_detils');
    }
}
