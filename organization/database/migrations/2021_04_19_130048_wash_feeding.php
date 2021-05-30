<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class WashFeeding extends Migration{
    public function up() {
        Schema::create('wash_feeding', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('orgId',36);
            $table->string('questionId');
            $table->string('answer');
            $table->char('type',36);
            $table->char('ans_type',36);
            $table->char('created_by',36)->nullable(true);
            $table->char('updated_by',36)->nullable(true);
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('wash_feeding');
    }
}
