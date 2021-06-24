<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Calender extends Migration
{
    public function up() {
        Schema::create('master_calender', function (Blueprint $table) {
            $table->char('id',36)->unique()->primary();
            $table->string('year',4)->nullable(false);
            $table->string('type',100)->nullable(false);
            $table->date('from_date')->nullable(false);
            $table->date('to_date')->nullable(false);
            $table->string('remarks',500)->nullable(true);
            $table->string('user_type',100)->nullable(true);
            $table->string('user_type',50)->nullable(true);
            $table->boolean('status')->default(1);
            $table->char('created_by',36)->nullable(true);
            $table->char('updated_by',50)->nullable(true);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    public function down(){
        Schema::dropIfExists('master_calender');
    }
}
