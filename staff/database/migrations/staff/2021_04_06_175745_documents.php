<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Documents extends Migration{
    public function up(){
        Schema::create('staff_documents', function (Blueprint $table) {
            $table->char('id',36)->unique()->primary();
            $table->char('parent_id',36)->nullable(false);
            $table->string('attachment_for',200)->nullable(true);
            $table->string('path',200)->nullable(false);
            $table->string('original_name',200)->nullable(false);
            $table->string('user_defined_name',200)->nullable(true);
        });
    }

    public function down(){
        Schema::dropIfExists('staff_documents');
    }
}
