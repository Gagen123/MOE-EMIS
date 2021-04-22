<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class HrWorkflow extends Migration
{
    public function up(){
        Schema::create('staff_program_workflow', function (Blueprint $table) {
            $table->char('id',36)->unique()->primary();
            $table->char('program_id',36)->nullable(false);
            $table->integer('sequence')->length(11)->unsigned()->nullable(false);
            $table->char('authority_type',36)->nullable(false);
            $table->char('sys_role_id',36)->nullable(false);
        });
    }
    public function down(){
        Schema::dropIfExists('staff_program_workflow');
    }
}
