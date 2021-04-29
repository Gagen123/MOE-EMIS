<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Participant extends Migration
{
    public function up(){
        Schema::create('staff_program_participant', function (Blueprint $table) {
            $table->char('id',36)->unique()->primary();
            $table->char('program_id',36)->nullable(false);
            $table->char('org_id',36)->nullable(false);
            $table->char('dzo_id',36)->nullable(false);
            $table->string('contact',50)->nullable(false);
            $table->string('email',100)->nullable(false);
            $table->string('nature_of_participant',100)->nullable(false);
            $table->string('attachment_details',250)->nullable();
            $table->date('dob',20)->nullable(true);
            $table->string('created_by',36)->nullable(true);
            $table->string('updated_by',36)->nullable(true);
            $table->timestamp('created_at')->nullable(true);
            $table->timestamp('updated_at')->nullable(true);
            $table->enum('status', ['Pending', 'Created'])->default('Pending')->nullable(false);
        });
    }
    public function down(){
        Schema::dropIfExists('staff_program_participant');
    }
}
