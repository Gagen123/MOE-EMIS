<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StaffNomination extends Migration{
    public function up(){
        Schema::create('stf_nomination', function (Blueprint $table) {
            $table->char('id',36)->unique()->primary();
            $table->char('personal_id',36)->nullable(false);
            $table->char('nomi_cid',36)->nullable(false);
            $table->string('nomi_name',200)->nullable(false);
            $table->char('nomi_desig',36)->nullable(false);
            $table->string('nomi_address',200)->nullable(true);
            $table->string('nomi_contact',36)->nullable(false);
            $table->string('nomi_email',200)->nullable(false);
            $table->char('nomi_relation',36)->nullable(false);
            $table->char('nomi_percentage',36)->nullable(false);
            $table->string('created_by',36)->nullable(true);
            $table->string('updated_by',36)->nullable(true);
            $table->timestamp('created_at')->nullable(true);
            $table->timestamp('updated_at')->nullable(true);
            $table->enum('status', ['Pending', 'Created'])->default('Pending')->nullable(false);
        });
    }

    public function down(){
        Schema::dropIfExists('stf_nomination');
    }
}
