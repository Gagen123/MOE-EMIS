<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockReceivedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_receiveds', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->date('dateOfreceived',36);
            $table->char('quarter_id',36);
            $table->string('remarks')->nullable(true);
            $table->string('approve_reject_remarks')->nullable(true);
            $table->char('organizationId',36)->nullable(false);
            $table->char('dzo_id',36)->nullable(false);
            $table->char('created_by',36)->nullable(true);
            $table->char('updated_by',36)->nullable(true);
            $table->char('status',20)->default('Submitted');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->char('approve_reject_by',36)->nullable();
            $table->timestamp('approve_reject_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_receiveds');
    }
}
