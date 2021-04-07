<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Village extends Migration{
    
    public function up(){
        Schema::create('village_master', function (Blueprint $table) {
            $table->increments('id',11);
            $table->integer('gewog_id')->length(11)->unsigned();
            $table->foreign('gewog_id')->references('id')->on('gewog_master');
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
        Schema::dropIfExists('village_master');
    }
}
