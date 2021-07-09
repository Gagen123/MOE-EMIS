<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CareerStagesHistory extends Migration
{
    public function up(){
        Schema::create('staff_career_stages_history', function (Blueprint $table) {
            $table->integer('record_id');
            $table->uuid('id');
            $table->char('staff_id',36)->nullable(false);
            $table->string('currier_stage')->nullable(false);
            $table->string('remarks')->nullable();
            $table->string('created_by',36)->nullable();
            $table->string('updated_by',36)->nullable();
            $table->string('recorded_by')->nullable();
            $table->timestamp('recorded_at')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    public function down(){
        Schema::dropIfExists('staff_career_stages_history');
    }
}
