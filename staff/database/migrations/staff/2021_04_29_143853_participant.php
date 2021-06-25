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
            $table->foreign('program_id')->references('id')->on('staff_program_details');
            $table->char('org_id',36)->nullable(false);
            $table->char('dzo_id',36)->nullable(false);
            $table->char('participant_id',36)->nullable(false);
            $table->foreign('participant_id')->references('id')->on('stf_staff');
            $table->string('contact',50)->nullable(false);
            $table->string('email',100)->nullable(false);
            $table->string('nature_of_participant',100)->nullable(false);
            $table->date('dob',20)->nullable(true);
            $table->string('remarks',500)->nullable();
            $table->string('created_by',36)->nullable(true);
            $table->string('updated_by',36)->nullable(true);
            $table->timestamp('created_at')->nullable(true);
            $table->timestamp('updated_at')->nullable(true);
            $table->string('status',50)->default('Pending')->nullable(false);
        });
    }
    public function down(){
        Schema::dropIfExists('staff_program_participant');
    }
}
