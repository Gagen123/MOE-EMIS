<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Substitution extends Migration
{
    public function up(){
        Schema::create('staff_substitution', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('cid',11)->nullable(false);
            $table->string('name',200)->nullable(false);
            $table->char('gender',36)->nullable(false);
            $table->char('dzongkhag',36)->nullable(false);
            $table->string('contact',50)->nullable();
            $table->string('email',100)->nullable();
            $table->string('qualification',100)->nullable(false);
            $table->string('remarks')->nullable();
            $table->char('created_by',36)->nullable();
            $table->char('updated_by',36)->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    public function down(){
        Schema::dropIfExists('staff_substitution');
    }
}
