<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StaffChildgroup extends Migration
{
    public function up(){
        Schema::create('master_child_group', function (Blueprint $table) {
            $table->char('id',36)->unique()->primary();
            $table->char('sub_group_id',36)->nullable(false);
            $table->string('name',150)->nullable(false);
            $table->boolean('status')->default(1);
            $table->string('code',4)->nullable();
            $table->string('description',225);
            $table->string('created_by',36);
            $table->string('updated_by',36);
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
        });
    }
    public function down(){
        Schema::dropIfExists('master_child_group');
    }
}
