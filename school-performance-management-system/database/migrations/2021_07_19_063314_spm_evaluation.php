<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SpmEvaluation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spm_evaluation', function (Blueprint $table) {
            $table->char('id',36)->primary();
            $table->year('evaluation_year');
            $table->char('org_id',36)->index();
            $table->unsignedTinyInteger('dzon_id')->index();
            $table->unsignedTinyInteger('spm_domain_subcat_id')->nullable()->index();
            $table->unsignedTinyInteger('status')->index();
            $table->string('remarks',500)->nullable();
            $table->char('created_by',36);
            $table->timestamps();

            $table->foreign('spm_domain_subcat_id')->references('id')->on('spm_domain_sub_category');



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spm_evaluation');
    }
}
