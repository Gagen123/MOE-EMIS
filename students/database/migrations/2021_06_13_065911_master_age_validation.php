<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MasterAgeValidation extends Migration
{
    public function up(){
        Schema::create('master_age_validation', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->date('date');
            $table->date('date1');
            $table->integer('no_months',11);
            $table->integer('no_months1',11);
            $table->tinyInteger('status');
            $table->char('created_by',36)->nullable(true);
            $table->char('updated_by',36)->nullable(true);
            $table->timestamps();
        });
    }

    public function down(){
        Schema::dropIfExists('master_age_validation');
    }
}
