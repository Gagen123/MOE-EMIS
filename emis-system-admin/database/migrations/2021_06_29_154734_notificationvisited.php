<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Notificationvisited extends Migration{
    public function up() {
        Schema::create('notification_visited', function (Blueprint $table) {
            $table->char('id',36)->unique()->primary();
            $table->string('notification_id',50)->nullable(false);
            $table->foreign('notification_id')->references('id')->on('notification_details');
            $table->string('user_id',255)->nullable(false);
        });
    }
    public function down(){
        Schema::dropIfExists('notification_visited');
    }
}
