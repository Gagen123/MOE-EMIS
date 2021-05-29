<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ManagementBodyComposition extends Migration
{
    public function up(){
        Schema::create('stf_mgmn_body_composition', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('management_id',36)->nullable(false);
            $table->char('emptye',36)->nullable(false);
            $table->string('name',200)->nullable(false);
            $table->char('designation',36)->nullable();
            $table->string('phone',200)->nullable(false);
            $table->string('email',200)->nullable(false);
            $table->string('address',200)->nullable(false);
            $table->date('from_date',15)->nullable(false);
            $table->date('to_date',15)->nullable(false);
        });
    }
    public function down(){
        Schema::dropIfExists('stf_mgmn_body_composition');
    }
}
