<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CareerStages extends Migration
{
    public function up(){
        Schema::create('staff_career_stages', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('staff_id',36)->nullable(false);
            $table->string('currier_stage')->nullable(false);
            $table->string('remarks')->nullable(true);
            $table->string('created_by',36)->nullable(true);
            $table->string('updated_by',36)->nullable(true);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    public function down(){
        Schema::dropIfExists('staff_career_stages');
    }
}
