<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Guideline extends Migration
{
    public function up() {
        Schema::create('master_guidelines', function (Blueprint $table) {
            $table->char('id',36)->unique()->primary();
            $table->string('guideline_for',100)->nullable(false);
            $table->string('guideline',500)->nullable(false);
            $table->string('display_order',10)->nullable(false);
            $table->boolean('status')->default(1);
            $table->string('created_by',36)->nullable(true);
            $table->string('updated_by',50)->nullable(true);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    public function down(){
        Schema::dropIfExists('master_guidelines');
    }
}
