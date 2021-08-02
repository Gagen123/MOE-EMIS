<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SpmParameter extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spm_parameter', function (Blueprint $table) {
            $table->char('id',36)->primary();
            $table->char('spm_area_id',36)->index();
            $table->string('code',100)->nullable();
            $table->string('name',100)->unique();
            $table->unsignedTinyInteger('status')->index();
            $table->char('created_by',36);
            $table->timestamps();
            $table->foreign('spm_area_id')->references('id')->on('spm_area');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spm_parameter');
    }
}
