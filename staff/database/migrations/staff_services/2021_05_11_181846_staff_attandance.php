<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StaffAttandance extends Migration
{
    public function up(){
        Schema::create('staff_attendance', function (Blueprint $table) {
            $table->char('id',36)->unique()->primary();
            $table->char('year',36)->nullable(false);
            $table->char('month',36)->nullable(false);
            $table->string('remarks')->nullable();
            $table->char('org_id')->nullable(false);
            $table->char('dzongkhag_id',36)->nullable(false);
            $table->string('created_by',36)->nullable(true);
            $table->string('updated_by',36)->nullable(true);
            $table->timestamp('created_at')->nullable(true);
            $table->timestamp('updated_at')->nullable(true);
        });
    }

    public function down(){
        Schema::dropIfExists('staff_attendance');
    }
}