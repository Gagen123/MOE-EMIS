<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_details', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('organizationId',36);
            // $table->foreign('organizationId')->references('id')->on('organization_details');
            $table->char('contactTypeId',36);
            $table->foreign('contactTypeId')->references('id')->on('contact_types');
            $table->string('phone');
            $table->string('mobile');
            $table->string('email');
            $table->tinyInteger('type');
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
        Schema::dropIfExists('contact_details');
    }
}
