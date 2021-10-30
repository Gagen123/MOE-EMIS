<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SpmAcademicProcessStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spm_academic_process_status', function (Blueprint $table) {
            $table->char('id', 36)->primary();
            $table->year('evaluation_year')->index();
            $table->unsignedTinyInteger('spm_domain_category_id')->index();
            $table->unsignedTinyInteger('status')->index()->comment('1 - Processed, 2-finalized');
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
        Schema::dropIfExists('spm_academic_process_status');
    }
}
