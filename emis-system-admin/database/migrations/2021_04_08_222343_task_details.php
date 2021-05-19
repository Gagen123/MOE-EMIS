<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TaskDetails extends Migration{
    public function up() {
        Schema::create('task_details', function (Blueprint $table) {
            $table->char('id',36)->unique()->primary();
            $table->string('application_number',100)->nullable(false);
            $table->string('service_name',150)->nullable(false);
            $table->string('table_name',150)->nullable(false);
            $table->char('screen_id',36)->nullable(false);
            $table->string('status_id',11)->nullable(false);
            $table->string('remarks',500)->nullable(true);
            $table->string('access_level',36)->nullable(false);
            $table->string('user_dzo_id',11)->nullable(false);
            $table->char('working_agency_id',36)->nullable(true);
            $table->char('app_role_id',36)->nullable(true);
            $table->char('record_type_id',36)->nullable(true);
            $table->string('claimed_by',36)->nullable(true);
            $table->string('created_by',36)->nullable(false);
            $table->timestamp('applied_on')->nullable();
            $table->timestamp('claimed_date')->nullable(true);
            $table->string('last_action_by',36)->nullable(false);
            $table->timestamp('last_action_date')->nullable();
        });
    }
    public function down(){
        Schema::dropIfExists('task_details');
    }
}
