<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StaffStages extends Migration{
    public function up(){
        Schema::create('application_attachments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('staff_id',36)->nullable(false);
            $table->string('currier_stage')->nullable(false);
            $table->string('remarks')->nullable(true);
            $table->string('created_by',36)->nullable(true);
            $table->string('updated_by',36)->nullable(true);
            $table->timestamps();
        });
    }
    public function down(){
        Schema::dropIfExists('application_attachments');
    }
}
