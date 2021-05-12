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
            $table->date('dateOfreceived');
            $table->char('quarter',36);
            $table->char('item',36);
            $table->char('receivedquantity',36);
            $table->char("'pending'+index'",36);
            $table->char('unit',36);
            $table->char('remarks',36);
            $table->char('created_by',36)->nullable(true);
            $table->char('updated_by',36)->nullable(true);
            $table->timestamps();
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
