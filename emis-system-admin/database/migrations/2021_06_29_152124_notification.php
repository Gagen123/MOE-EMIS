<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Notification extends Migration
{
    public function up() {
        Schema::create('notification_details', function (Blueprint $table) {
            $table->char('id',36)->unique()->primary();
            $table->string('notification_for',50)->nullable(false);
            $table->string('notification_appNo',50)->nullable(true);
            $table->string('notification_message',255)->nullable(true);
            $table->string('notification_type',50)->nullable(false)->comment('specific user, roles');
            $table->string('notification_access_type',50)->nullable(false)->comment('dzongkhag level, org level, all');
            $table->char('access_level',20);
            $table->string('call_back_link',225)->nullable();
            $table->char('created_by',36)->nullable(true);
            $table->char('updated_by',50)->nullable(true);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
<<<<<<< HEAD
        Schema::create('notification_details_audit', function (Blueprint $table) {
            $table->increments('audit_id',11);
            $table->char('id',36);
            $table->string('notification_for',50)->nullable(false);
            $table->string('notification_appNo',50)->nullable(true);
            $table->string('notification_message',255)->nullable(true);
            $table->string('notification_type',50)->nullable(false)->comment('specific user, roles');
            $table->string('notification_access_type',50)->nullable(false)->comment('dzongkhag level, org level, all');
            $table->char('access_level',20);
            $table->string('call_back_link',225)->nullable();
            $table->char('created_by',36)->nullable(true);
            $table->char('updated_by',50)->nullable(true);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('audited_at')->nullable();
            $table->timestamp('audited_by')->nullable();
        });
=======
>>>>>>> a2c0551d466c551c1a2f9319d1f8a2e18de386bb
    }
    public function down(){
        Schema::dropIfExists('notification_details');
    }
}
