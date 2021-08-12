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
            $table->unsignedTinyInteger('spm_domain_category_id')->index();
            $table->string('name',100)->unique();
            $table->unsignedSmallInteger('sequence_no')->index();
            $table->unsignedTinyInteger('status')->index();
            $table->char('created_by',36);
            $table->timestamps();

            $table->foreign('spm_domain_category_id')->references('id')->on('spm_domain_category');

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
