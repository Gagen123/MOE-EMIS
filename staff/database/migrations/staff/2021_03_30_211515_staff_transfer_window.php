<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StaffTransferWindow extends Migration{
    public function up() {
        Schema::create('stf_transfer_window', function (Blueprint $table) {
            $table->char('id',36)->unique()->primary();
            $table->char('year',4)->nullable(false);
            $table->date('from_date',10)->nullable(false);
            $table->date('to_date',10)->nullable(false);
            $table->string('remarks')->nullable(true);
            $table->string('created_by',36)->nullable(true);
            $table->string('updated_by',36)->nullable(true);
            $table->timestamp('created_at')->nullable(true);
            $table->timestamp('updated_at')->nullable(true);
            $table->enum('status', ['0', '1'])->default('1')->nullable(false);
        });
    }

    public function down() {
        Schema::dropIfExists('stf_transfer_window');
    }
}
