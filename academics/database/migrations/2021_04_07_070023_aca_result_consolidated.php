<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AcaResultConsolidated extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aca_result_consolidated', function (Blueprint $table) {
            $table->char('id',36)->primary();
            $table->char('org_id',36)->index();
            $table->char('aca_assmt_term_id',36)->index()->nullable()->comment('Null for final/annual result');
            $table->char('org_class_id',36)->index();
            $table->char('org_stream_id',36)->index()->nullable();
            $table->char('org_section_id',36)->index()->nullable();
            $table->string('class_stream_section',100);
            $table->unsignedTinyInteger('finalized')->nullable()->default(0)->index();
            $table->dateTime('finalized_date')->nullable();
            $table->unsignedTinyInteger('published')->nullable()->default(0)->index();
            $table->dateTime('published_date')->nullable();
            $table->string('created_by',36)->index();
            $table->string('updated_by',36)->index()->nullable();
            $table->timestamps();

            $table->foreign('aca_assmt_term_id')->references('id')->on('aca_assessment_term');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aca_result_consolidated');
    }
}
