<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MessTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('mess_transaction_table', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('organizationId');
            $table->char('item_id');
            $table->date('procured_type');
            $table->char('available_qty',36);
            $table->char('created_by',36)->nullable(true);
            $table->char('updated_by',36)->nullable(true);
            $table->timestamps('created_at')->nullable(true);
            $table->timestamps('updated_at')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('mess_transaction_table');
    }
}
