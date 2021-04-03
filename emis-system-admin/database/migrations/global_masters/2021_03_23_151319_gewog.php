<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Gewog extends Migration{
    public function up() {
        Schema::create('gewog_master', function (Blueprint $table) {
            $table->increments('id',11);
            $table->integer('dzongkhag_id')->length(11)->unsigned();
            $table->foreign('dzongkhag_id')->references('id')->on('dzongkhag_master');
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
        Schema::dropIfExists('gewog_master');
    }
}
