<?php

use Database\Seeders\StatusSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SpmStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spm_status', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('name',500);
            $table->char('created_by',36);
            $table->timestamps();
        });
        $seeder = new StatusSeeder();
        $seeder->run();
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
