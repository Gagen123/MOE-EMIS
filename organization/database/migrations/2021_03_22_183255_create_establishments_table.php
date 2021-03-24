<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstablishmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('establishments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('proposedName');
            $table->tinyInteger('category');
            $table->char('levelId',36);
            $table->char('dzongkhagId',36);
            $table->char('gewogId',36);
            $table->char('chiwogId',36);
            $table->char('locationId',36);
            $table->tinyInteger('isGeopoliticallyLocated');
            $table->tinyInteger('isSenSchool');
            $table->char('parentSchoolId',36)->nullable(true);
            $table->tinyInteger('isColocated')->nullable(true);;
            $table->integer('cid')->nullable(true);
            $table->string('fullName')->nullable(true);
            $table->integer('phoneNo')->nullable(true);
            $table->string('email')->nullable(true);
            $table->tinyInteger('statusId')->nullable(true);
            $table->string('applicationNo');
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
        Schema::dropIfExists('establishments');
    }
}
