<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TransfrApplication extends Migration
{
    public function up(){
        Schema::create('transfer_application', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('aplication_number',36)->nullable();
            $table->char('transfer_window_id',36)->nullable(false);
            $table->char('staff_id',36)->nullable(false);
            $table->char('transfer_reason_id',36)->nullable(false);
            $table->string('description',500)->nullable();
            $table->string('created_by',36)->nullable(true);
            $table->string('updated_by',36)->nullable(true);
            $table->timestamp('created_at')->nullable(true);
            $table->timestamp('updated_at')->nullable(true);
            $table->string('status',50)->nullable(false);
            $table->string('dzongkhagApproved',36)->nullable(true);
        });
    }
    public function down(){
        Schema::dropIfExists('transfer_application');
    }
}
