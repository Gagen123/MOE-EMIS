<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DietaryDates extends Migration{
    public function up(){
        Schema::create('dietary_dates', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('basic_id',36)->nullable(false);
            $table->date('record_date')->nullable(false);
            $table->char('total_score',36)->nullable(false);
        });
    }
    public function down(){
        Schema::dropIfExists('dietary_dates');
    }
}
