<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TransfrPreferenceApplication extends Migration
{
    public function up(){
        Schema::create('transfer_preferemce_application', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('transfer_application_id',36)->nullable(false);
            $table->char('dzongkhag_id',36)->nullable();
            $table->string('preference',10)->nullable();
            $table->string('created_by',36)->nullable(true);
            $table->string('updated_by',36)->nullable(true);
            $table->timestamp('created_at')->nullable(true);
            $table->timestamp('updated_at')->nullable(true);
        });
    }
    public function down(){
        Schema::dropIfExists('transfer_preferemce_application');
    }
}
