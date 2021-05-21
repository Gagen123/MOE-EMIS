<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StaffServiceType extends Migration
{
    public function up(){
        Schema::create('master_staff_serice_type', function (Blueprint $table) {
            $table->char('id',36)->unique()->primary();
            $table->char('parent_id',36)->nullable(false);
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
        Schema::dropIfExists('master_staff_serice_type');
    }
}
