<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SpmDomain extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spm_domain', function (Blueprint $table) {
            $table->char('id',36)->primary();
            $table->string('code',100);
            $table->string('name',100)->unique();
            $table->unsignedTinyInteger('status')->index();
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
        Schema::dropIfExists('spm_domain');
    }
}
