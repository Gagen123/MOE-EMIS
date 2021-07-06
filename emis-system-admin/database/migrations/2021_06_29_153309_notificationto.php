<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Notificationto extends Migration
{
    public function up() {
        Schema::create('notification_to', function (Blueprint $table) {
            $table->char('id',36)->unique()->primary();
            $table->string('notification_id',50)->nullable(false);
            $table->foreign('notification_id')->references('id')->on('notification_details');
            $table->char('dzo_id',36);
            $table->char('access_level',20);
            $table->char('working_agency_id',36);
            $table->string('user_role_id',255)->nullable(false);
        });
<<<<<<< HEAD
        Schema::create('notification_to_audit', function (Blueprint $table) {
            $table->increments('audit_id',11);
            $table->char('id',36);
            $table->string('notification_id',50)->nullable(false);
            $table->foreign('notification_id')->references('id')->on('notification_details');
            $table->char('dzo_id',36);
            $table->char('access_level',20);
            $table->char('working_agency_id',36);
            $table->string('user_role_id',255)->nullable(false);
            $table->timestamp('audited_at')->nullable();
            $table->timestamp('audited_by')->nullable();
        });
=======
>>>>>>> a2c0551d466c551c1a2f9319d1f8a2e18de386bb
    }
    public function down(){
        Schema::dropIfExists('notification_to');
    }
}
