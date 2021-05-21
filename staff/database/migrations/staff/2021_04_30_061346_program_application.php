<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProgramApplication extends Migration
{
    public function up(){
        Schema::create('program_application', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('program_id',36)->nullable(false);
            $table->char('org_id',36)->nullable(false);
            $table->char('dzo_id',36)->nullable(false);
            $table->string('app_no',36)->nullable(false);
            $table->string('remarks',500)->nullable();
            $table->string('created_by',36)->nullable(true);
            $table->string('updated_by',36)->nullable(true);
            $table->timestamp('created_at')->nullable(true);
            $table->timestamp('updated_at')->nullable(true);
            $table->string('status',50)->nullable(false);
        });
    }
    public function down(){
        Schema::dropIfExists('program_application');
    }
}
