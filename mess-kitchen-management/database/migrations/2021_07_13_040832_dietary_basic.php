<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DietaryBasic extends Migration{
    public function up(){
        Schema::create('dietary_basic_info', function (Blueprint $table) {
            $table->uuid('id')->primary();
            // $table->date('date')->nullable(false);
            $table->char('average_score',11)->nullable(false);
            $table->string('prepared_by',200)->nullable();
            $table->string('endrosed_by',200)->nullable(false);
            $table->char('organizationId',36)->nullable(false);
            // $table->char('score',11)->nullable(false);
            $table->char('remarks',36)->nullable();
            $table->char('created_by',36)->nullable();
            $table->char('updated_by',36)->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    public function down(){
        Schema::dropIfExists('dietary_basic_info');
    }
}
