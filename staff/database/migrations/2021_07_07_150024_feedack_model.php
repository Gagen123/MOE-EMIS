<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FeedackModel extends Migration{
    public function up(){
        Schema::create('staff_feedback_details', function (Blueprint $table) {
            $table->char('id',36)->unique()->primary();
            $table->char('feedback_provider_id',36)->nullable(false);
            $table->char('questionId',36)->nullable(false);
            $table->char('selection_type_id',36)->nullable(false);
            $table->char('position_title_id',36)->nullable(false);
            $table->string('ans_type',100)->nullable(false);
            $table->string('answer',500)->nullable(false);
            $table->string('created_by',36)->nullable(true);
            $table->string('updated_by',50)->nullable(true);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    public function down(){
        Schema::dropIfExists('staff_feedback_details');
    }
}
