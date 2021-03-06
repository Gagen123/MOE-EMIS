<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Database\Seeders\AssessmentTermSeeder;


class AcaAssessmentTerm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aca_assessment_term', function (Blueprint $table) {
            $table->char('id',36)->primary();
            $table->char('aca_assmt_frequency_id',36)->index();
            $table->unsignedTinyInteger('term_number')->index();
            $table->string('name',100)->unique();
            $table->string('dzo_name',1000)->nullable();
            $table->string('display_text',100)->nullable();
            $table->unsignedTinyInteger('from_month');
            $table->unsignedTinyInteger('to_month');
            $table->unsignedTinyInteger('from_date')->nullable();
            $table->unsignedTinyInteger('to_date')->nullable();
            $table->unsignedTinyInteger('display_order')->index();
            $table->unsignedTinyInteger('status')->index()->default(1)->comment('0 - Disabled');
            $table->string('created_by',36)->index();
            $table->string('updated_by',36)->index()->nullable();
            $table->timestamps();

            $table->foreign('aca_assmt_frequency_id')->references('id')->on('aca_assessment_frequency');

        });
        $seeder = new AssessmentTermSeeder();
        $seeder->run();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aca_assessment_term');
    }
}
