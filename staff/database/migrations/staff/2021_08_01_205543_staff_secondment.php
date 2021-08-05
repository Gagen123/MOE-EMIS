<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StaffSecondment extends Migration{
    public function up(){
        Schema::create('staff_secondment', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('staff_id',36)->nullable(false);
            $table->foreign('staff_id')->references('id')->on('stf_staff');
            $table->char('secondment_id',36)->nullable(false);
            $table->foreign('secondment_id')->references('id')->on('master_secondment');
            $table->date('from_date',20)->nullable(false);
            $table->date('to_date',20)->nullable(false);
            $table->string('agency',255)->nullable();
            $table->string('remarks')->nullable();
            $table->char('created_by',36)->nullable();
            $table->char('updated_by',36)->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    public function down(){
        Schema::dropIfExists('staff_secondment');
    }
}
