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
        Schema::create('application_details', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('proposedName');
            $table->tinyInteger('category');
            $table->char('levelId',36);
            $table->foreign('levelId')->references('id')->on('level');
            $table->char('dzongkhagId',36);
            $table->char('gewogId',36);
            $table->char('chiwogId',36);
            $table->char('locationId',36);
            $table->foreign('locationId')->references('id')->on('location');
            $table->tinyInteger('isGeopoliticallyLocated');
            $table->tinyInteger('isSenSchool');
            $table->char('parentSchoolId',36)->nullable(true);
            $table->tinyInteger('isColocated')->nullable(true);;
            $table->string('status')->nullable(true)->comment('Pending->Submitted->Under Process or Rejectd->Approved ->Registered');
            $table->string('applicationNo');
            $table->char('isfeedingschool',5)->nullable(true);
            $table->string('feeding',10)->nullable(true);
            $table->string('service');
            $table->char('organizationId',36)->nullable(true);
            $table->foreign('organizationId')->references('id')->on('organization_details');
            $table->string('reason')->nullable(true);
            $table->string('remark')->nullable(true);
            $table->char('oldOrganizationId1',36)->nullable(true);
            $table->char('oldOrganizationId2',36)->nullable(true);
            $table->string('year')->nullable(true);
            $table->char('created_by',36)->nullable(true);
            $table->char('updated_by',36)->nullable(true);
            $table->string('updated_remarks')->nullable(true);
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
