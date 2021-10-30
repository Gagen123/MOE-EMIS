<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SpmStemSubjectPoint extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spm_stem_subject_point', function (Blueprint $table) {
            $table->unsignedTinyInteger('id');
            $table->unsignedTinyInteger('spm_domain_subcat_id')->index();
            $table->decimal('difference_from', 6, 2);
            $table->decimal('difference_to', 6, 2);
            $table->unsignedDecimal('points', 6, 2);
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
        Schema::dropIfExists('spm_stem_subject_point');
    }
}
