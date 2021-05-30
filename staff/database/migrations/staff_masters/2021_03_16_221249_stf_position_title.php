<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StfPositionTitle extends Migration{
    
    public function up(){
        Schema::create('master_stf_position_title', function (Blueprint $table) {
            $table->char('id',36)->unique()->primary();
            $table->char('sub_group_id',36)->nullable(false);
            $table->foreign('sub_group_id')->references('id')->on('master_stf_sub_group');
            $table->string('name',150)->nullable(false);
            $table->char('position_level_id',36)->nullable();
            $table->char('code',4)->nullable(false);
            $table->boolean('status')->default(1);
            $table->string('created_by',36)->nullable(true);
            $table->string('updated_by',36)->nullable(true);
            $table->timestamp('created_at')->nullable(true);
            $table->timestamp('updated_at')->nullable(true);
        });
    }

    public function down(){
        Schema::dropIfExists('master_stf_position_title');
    }
}
