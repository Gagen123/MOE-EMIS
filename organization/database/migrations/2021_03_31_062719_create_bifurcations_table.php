<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBifurcationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bifurcations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('applicationNo');
            $table->char('parentOrgId', 36);
            $table->string('new1Name');
            $table->char('new1Level', 36);
            $table->tinyInteger('new1Category');
            $table->char('new1Dzongkhag', 36);
            $table->char('new1Gewog', 36);
            $table->char('new1Chiwog', 36);
            $table->char('new1Location', 36);
            $table->tinyInteger('new1IsGeoLocated')->nullable(true);
            $table->tinyInteger('new1IsSenSchool');
            $table->tinyInteger('new1IsCoLocated')->nullable(true);
            $table->char('new1ParentSchool', 36)->nullable(true);

            $table->string('new2Name');
            $table->char('new2Level', 36);
            $table->tinyInteger('new2Category');
            $table->char('new2Dzongkhag', 36);
            $table->char('new2Gewog', 36);
            $table->char('new2Chiwog', 36);
            $table->char('new2Location', 36);
            $table->tinyInteger('new2IsGeoLocated')->nullable(true);
            $table->tinyInteger('new2IsSenSchool');
            $table->tinyInteger('new2IsCoLocated')->nullable(true);
            $table->char('new2ParentSchool', 36)->nullable(true);
            $table->string('status')->nullable(true)->comment('Pending->Submitted->Under Process or Rejectd->Approved ->Registered');
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
        Schema::dropIfExists('bifurcations');
    }
}
