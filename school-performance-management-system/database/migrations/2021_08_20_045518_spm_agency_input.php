<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SpmAgencyInput extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spm_agency_input', function (Blueprint $table) {
            $table->char('id',36)->primary();
            $table->char('division_id',36)->index()->nullable();
            $table->year('input_year');
            $table->string('input',1000);
            $table->string('activity',1000);
            $table->string('output',1000);
            $table->char('created_by',36);
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
        Schema::dropIfExists('spm_agency_input');
    }
}
