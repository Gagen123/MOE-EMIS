<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StaffResponsibilities extends Migration
{
    public function up(){
        Schema::create('staff_responsibilities', function (Blueprint $table) {
            $table->char('id',36)->unique()->primary();
            $table->char('staff_id',36)->nullable(false);
            $table->char('responsibility',36)->nullable(false);
            $table->string('remarks')->nullable();
            $table->string('created_by',36)->nullable();
            $table->string('updated_by',36)->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    public function down(){
        Schema::dropIfExists('staff_responsibilities');
    }
}
