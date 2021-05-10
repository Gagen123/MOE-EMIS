<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocalProcuresTable extends Migration
{
    /**
     * Run the migrations.
     * 
     * @return void
     */
    public function up()
    {
        Schema::create('local_procures', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->date('dateOfprocure');
            $table->char('item',36);
            $table->char('quantity',36);
            $table->char('unit',36);
            $table->char('amount',36);
            $table->char('remark',36);
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
        Schema::dropIfExists('local_procures');
    }
}
