<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class QuestionDetials extends Migration
{
    public function up(){
        Schema::create('question_details', function (Blueprint $table) {
            $table->char('id',36)->unique()->primary();
            $table->char('category_type_id',36)->nullable(false);
            $table->char('leadership_type_id',36)->nullable(false);
            $table->string('name',200)->nullable(false);
            $table->string('answer_type',150)->nullable(true);
            $table->string('display_order',11)->nullable(true);
            $table->boolean('status')->default(1);
            $table->string('created_by',36)->nullable(true);
            $table->string('updated_by',50)->nullable(true);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
        Schema::create('answer_details', function (Blueprint $table) {
            $table->char('id',36)->unique()->primary();
            $table->char('question_id',36)->nullable(false);
            $table->string('name',200)->nullable(false);
            $table->boolean('status')->default(1);
            $table->string('created_by',36)->nullable(true);
            $table->string('updated_by',50)->nullable(true);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    public function down(){
        Schema::dropIfExists('question_details');
        Schema::dropIfExists('answer_details');
    }
}
