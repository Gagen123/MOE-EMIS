<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SpmArea extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spm_area', function (Blueprint $table) {
            $table->char('id',36)->primary();
            $table->char('spm_domain_id',36)->index();
            $table->string('code',100);
            $table->string('name',100)->unique();
            $table->unsignedTinyInteger('status')->index();
            $table->char('created_by',36);
            $table->timestamps();

            $table->foreign('spm_domain_id')->references('id')->on('spm_domain');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spm_area');
    }
}
