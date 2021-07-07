<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Feedbackcategory extends Migration
{
    public function up(){
        Schema::create('staff_leadership_feedback_category', function (Blueprint $table) {
            $table->char('id',36)->unique()->primary();
            $table->string('name',200)->nullable(false);
            $table->string('type',150)->nullable(true);
            $table->boolean('status')->default(1);
            $table->string('created_by',36)->nullable(true);
            $table->string('updated_by',50)->nullable(true);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    public function down(){
        Schema::dropIfExists('staff_leadership_feedback_category');
    }
}
