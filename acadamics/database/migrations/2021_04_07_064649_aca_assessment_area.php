<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Database\Seeders\AssessmentAreaSeeder;


class AcaAssessmentArea extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aca_assessment_area', function (Blueprint $table) {
            $table->char('id',36)->primary();
            $table->char('aca_sub_id', 36)->index();
            $table->string('name',100);
            $table->string('code',10);
            $table->char('aca_rating_type_id',36)->index()->nullable();
            $table->unsignedTinyInteger('display_order')->index();
            $table->unsignedTinyInteger('status')->index()->default(1)->comment('0-Disabled');
            $table->string('created_by',36)->index();
            $table->string('updated_by',36)->index()->nullable();
            $table->timestamps();

            $table->foreign('aca_sub_id')->references('id')->on('aca_subject');
            $table->foreign('aca_rating_type_id')->references('id')->on('aca_rating_type');
            $table->unique(['aca_sub_id','name']);

        });
        $seeder = new AssessmentAreaSeeder();
        $seeder->run();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aca_assessment_area');
    }
}
