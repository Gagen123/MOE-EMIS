<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StaffAwards extends Migration
{
    public function up(){
        Schema::create('staff_awards', function (Blueprint $table) {
            $table->char('id',36)->unique()->primary();
            $table->char('staff_id',36)->nullable(false);
            $table->string('award_given_by',150)->nullable(false);
            $table->char('award_type_id',36)->nullable(false);
            $table->date('date')->nullable(true);
            $table->string('place',200)->nullable(false);
            $table->string('remarks')->nullable();
            $table->string('coursetitle',150)->nullable();
            $table->string('created_by',36)->nullable(true);
            $table->string('updated_by',36)->nullable(true);
            $table->timestamp('created_at')->nullable(true);
            $table->timestamp('updated_at')->nullable(true);
        });
    }

    public function down(){
        Schema::dropIfExists('staff_awards');
    }
}
