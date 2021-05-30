<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StaffQualification extends Migration{
    public function up(){
        Schema::create('stf_qualification', function (Blueprint $table) {
            $table->char('id',36)->unique()->primary();
            $table->char('personal_id',36)->nullable(false);
            $table->char('description',36)->nullable(false);
            $table->char('qualification',36)->nullable(false);
            $table->char('coursemode',36)->nullable(false);
            $table->string('coursetitle',200)->nullable(false);
            $table->char('first_subject',36)->nullable(false);
            $table->char('second_subject',36)->nullable(true);
            $table->char('country',36)->nullable(false);
            $table->date('startdate',20)->nullable(false);
            $table->date('enddate',20)->nullable(false);
            $table->string('created_by',36)->nullable(true);
            $table->string('updated_by',36)->nullable(true);
            $table->timestamp('created_at')->nullable(true);
            $table->timestamp('updated_at')->nullable(true);
            $table->enum('status', ['Pending', 'Created'])->default('Pending')->nullable(false);
        });
    }
    public function down(){
        Schema::dropIfExists('stf_qualification');
    }
}
