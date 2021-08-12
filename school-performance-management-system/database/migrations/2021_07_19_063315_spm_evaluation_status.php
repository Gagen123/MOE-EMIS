<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SpmEvaluationStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        

            Schema::create('spm_evaluation_status', function (Blueprint $table) {
                $table->char('id',36)->primary();
                $table->unsignedTinyInteger('status')->index();
                $table->date('status_date')->index();
                $table->char('status_by',36);
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
        Schema::dropIfExists('spm_evaluation_status');
    }
}
