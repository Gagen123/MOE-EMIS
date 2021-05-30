<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StaffDisaplinary extends Migration
{
    public function up(){
        Schema::create('staff_disaplinary', function (Blueprint $table) {
            $table->char('id',36)->unique()->primary();
            $table->char('staff_id',36)->nullable(false);
            $table->date('offence_date')->nullable(false);
            $table->char('offence_type_id',36)->nullable(false);
            $table->char('offence_severity_id',36)->nullable(false);
            $table->char('offence_action_id',36)->nullable(false);
            $table->string('offence_description')->nullable();
            $table->string('description_on_action')->nullable();
            $table->string('created_by',36)->nullable(true);
            $table->string('updated_by',36)->nullable(true);
            $table->timestamp('created_at')->nullable(true);
            $table->timestamp('updated_at')->nullable(true);
        });
    }

    public function down(){
        Schema::dropIfExists('staff_disaplinary');
    }
}
