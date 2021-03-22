<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StfCureerStage extends Migration{
   
    public function up(){
        Schema::create('stf_cureer_stage', function (Blueprint $table) {
            $table->char('id',36)->unique()->primary();
            $table->string('name',150)->nullable(false);
            $table->char('code',4)->nullable(false);
            $table->boolean('status')->default(1);
            $table->string('created_by',36)->nullable(true);
            $table->string('updated_by',36)->nullable(true);
            $table->timestamp('created_at')->nullable(true);
            $table->timestamp('updated_at')->nullable(true);
        });
    }

    public function down() {
        Schema::dropIfExists('stf_cureer_stage');
    }
}
