<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LeadershipType extends Migration{
    public function up(){
        Schema::create('master_staff_leadership_type', function (Blueprint $table) {
            $table->char('id',36)->unique()->primary();
            $table->string('name',200)->nullable(false);
            $table->boolean('isfeedbackapplicable')->default(1);
            $table->string('type',150)->nullable(true);
            $table->boolean('status')->default(1);
            $table->string('created_by',36)->nullable(true);
            $table->string('updated_by',50)->nullable(true);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    public function down(){
        Schema::dropIfExists('master_staff_leadership_type');
    }
}
