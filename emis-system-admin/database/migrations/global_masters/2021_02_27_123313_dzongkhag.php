<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Dzongkhag extends Migration
{
    public function up() {
        Schema::create('dzongkhag_master', function (Blueprint $table) {
            $table->increments('id',11);
            $table->string('name',150)->nullable(false);
            $table->string('code',150)->nullable(false);
            $table->boolean('status')->default(1);
            $table->string('created_by',36)->nullable(true);
            $table->string('updated_by',50)->nullable(true);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dzongkhag_master');
    }
}
