<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StfQualification extends Migration{
    public function up(){
        Schema::create('master_stf_qualification', function (Blueprint $table) {
            $table->char('id',36)->unique()->primary();
            $table->char('q_level_id',36)->nullable(false);
            $table->string('description',255)->nullable(false);
            $table->foreign('q_level_id')->references('id')->on('master_stf_qualification_level');
            $table->char('q_type_id',36)->nullable(false);
            $table->foreign('q_type_id')->references('id')->on('master_stf_qualification_type');
            $table->string('name',150)->nullable(false);
            $table->char('code',4)->nullable(false);
            $table->boolean('status')->default(1);
            $table->string('created_by',36)->nullable(true);
            $table->string('updated_by',36)->nullable(true);
            $table->timestamp('created_at')->nullable(true);
            $table->timestamp('updated_at')->nullable(true);
        });
    }

    public function down(){
        Schema::dropIfExists('master_stf_qualification');
    }
}
