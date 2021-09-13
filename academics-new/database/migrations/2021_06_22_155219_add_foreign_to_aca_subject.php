<?php

use Database\Seeders\SubjectSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignToAcaSubject extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('aca_subject', function (Blueprint $table) {
            $table->foreign('aca_sub_category_id')->references('id')->on('aca_subject_category');
            $table->foreign('aca_sub_id')->references('id')->on('aca_subject');
        });
  
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('aca_subject', function (Blueprint $table) {
            $table->dropForeign(['aca_sub_category_id']);
            $table->dropForeign(['aca_sub_id']);
        });
    }
}
