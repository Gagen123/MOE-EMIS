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
            $table->char('dzongkhagId',36);
            $table->char('gewogId',36);
            $table->char('chiwogId',36);
            $table->char('locationId',36);
            $table->tinyInteger('isGeopoliticallyLocated');
            $table->tinyInteger('isSenSchool');
            $table->char('parentSchoolId',36)->nullable(true);
            $table->tinyInteger('isColocated')->nullable(true);;
            $table->string('status')->nullable(true)->comment('Pending->Submitted->Under Process or Rejectd->Approved ->Registered');
            $table->string('applicationNo');
            $table->string('service');
            $table->char('organizationId',36)->nullable(true);
            $table->string('reason')->nullable(true);
            $table->string('remark')->nullable(true);
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
