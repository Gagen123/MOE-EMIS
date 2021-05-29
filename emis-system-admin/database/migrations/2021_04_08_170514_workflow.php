<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class Workflow extends Migration{
    public function up() {
        Schema::create('workflow_details', function (Blueprint $table) {
            $table->char('id',36)->unique()->primary();
            $table->string('database_name',150)->nullable(false);
            $table->string('service_name',150)->nullable(false);
            $table->string('table_name',150)->nullable(false);
            $table->string('application_number',100)->nullable(false);
            $table->char('screen_id',36)->nullable(false);
            $table->string('status_id',11)->nullable(false);
            $table->string('remarks',500)->nullable(true);
            $table->string('action_by',36)->nullable(false);
            $table->timestamp('action_date')->nullable();
        });
    }

    public function down() {
        Schema::dropIfExists('workflow_details');
    }
}
