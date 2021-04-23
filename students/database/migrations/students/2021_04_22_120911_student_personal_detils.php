<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StudentPersonalDetils extends Migration{
    
    public function up(){
        Schema::create('std_personal_detils', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('snationality');
            $table->char('cid_passport',60)->nullable(false);
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->string('dob',10)->nullable(false);
            $table->char('sex_id',36)->nullable(false);
            $table->char('village_id',36)->nullable();
            $table->string('address')->nullable();
            $table->char('mother_tongue',36)->nullable();
            $table->string('attachments')->nullable();
            $table->char('status',20)->default('pending');
            $table->char('created_by',36)->nullable(true);
            $table->char('updated_by',36)->nullable(true);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    public function down(){
        Schema::dropIfExists('std_personal_detils');
    }
}
