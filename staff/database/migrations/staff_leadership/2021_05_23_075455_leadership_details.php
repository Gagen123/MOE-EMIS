<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LeadershipDetails extends Migration
{
    public function up(){
        Schema::create('staff_leadership_detials', function (Blueprint $table) {
            $table->char('id',36)->unique()->primary();
            $table->char('selection_type',36)->nullable(false);
            $table->char('position_title',36)->nullable(false);
            $table->date('from_date')->nullable(false);
            $table->date('to_date')->nullable(false);
            $table->string('details')->nullable();
            $table->char('status',20)->default('pending');
            $table->string('created_by',36)->nullable(true);
            $table->string('updated_by',36)->nullable(true);
            $table->timestamp('created_at')->nullable(true);
            $table->timestamp('updated_at')->nullable(true);
        });
    }

    public function down(){
        Schema::dropIfExists('staff_leadership_detials');
    }
}
