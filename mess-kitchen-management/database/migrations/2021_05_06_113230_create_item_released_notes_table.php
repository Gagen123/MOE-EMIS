<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemReleasedNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_released_notes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('foodreleaseId',36);
            $table->string('item');
            //$table->foreign('itemId')->references('id')->on('item');
            $table->integer('quantity')->length(11)->unsigned()->nullable(false);
            $table->string('unit');
            $table->string('remark')->nullable(true);
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
        Schema::dropIfExists('item_released_notes');
    }
}
