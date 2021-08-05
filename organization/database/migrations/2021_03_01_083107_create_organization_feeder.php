<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationFeeder
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organization_feeder', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('feederschool',36);
            $table->char('classvii');
            $table->char('classix');
            $table->char('classxi');
            $table->char('remarks');
            $table->char('parentschool');
            $table->char('created_by',36)->nullable(true);
            $table->char('created_at',36)->nullable(true);
            $table->char('updated_by',36)->nullable(true);
            $table->timestamp('updated_at',36)->nullable(true);
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
        Schema::dropIfExists('organization_feeder');
    }
}
