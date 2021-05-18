<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ApplicationSeuence extends Migration
{
    public function up(){
        Schema::create('application_sequence', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('service_name');
            $table->tinyInteger('last_sequence');
        });
    }
    public function down(){
        Schema::dropIfExists('application_sequence');
    }
}
