<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ManagementBodyDetails extends Migration{
    public function up(){
        Schema::create('stf_mgmn_body_details', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('body_type_id',36)->nullable(false);
            $table->date('from_date',10)->nullable(false);
            $table->date('to_date',10)->nullable(false);
            $table->char('org_id',36)->nullable();
            $table->char('dzongkhag_id',36)->nullable();
            $table->string('remarks',500)->nullable();
            $table->string('created_by',36)->nullable(true);
            $table->string('updated_by',36)->nullable(true);
            $table->timestamp('created_at')->nullable(true);
            $table->timestamp('updated_at')->nullable(true);
            $table->string('status',50)->nullable(false);
        });
    }
    public function down(){
        Schema::dropIfExists('stf_mgmn_body_details');
    }
}
