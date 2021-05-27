<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CategoryType extends Migration
{
    public function up() {
        Schema::create('category_type', function (Blueprint $table) {
            $table->char('id',36);
            $table->char('parent_id',36)->nullable(false);
            $table->string('name',150)->nullable(false);
            $table->boolean('status')->default(1);
            $table->string('type',100)->nullable(true);
            $table->string('created_by',36)->nullable(true);
            $table->string('updated_by',50)->nullable(true);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('question_category');
    }
}
