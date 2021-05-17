<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AcaResultConsolidatedDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aca_result_consolidated_detail', function (Blueprint $table) {
            $table->char('id',36)->primary();
            $table->char('aca_result_consolidated_id',36)->index();
            $table->char('std_student_id',36)->index();
            $table->unsignedTinyInteger('result')->index()->default(1)->comment('1-Promoted; 0-Detained');
            $table->string('remarks',500)->nullable();
            $table->string('created_by',36)->index();
            $table->string('updated_by',36)->index()->nullable();
            $table->timestamps();

            $table->foreign('aca_result_consolidated_id')->references('id')->on('aca_result_consolidated')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aca_result_consolidated_detail');
    }
}
