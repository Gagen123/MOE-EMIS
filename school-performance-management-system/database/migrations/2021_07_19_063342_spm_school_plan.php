<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SpmSchoolPlan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spm_school_plan', function (Blueprint $table) {
            $table->char('id',36)->primary();
            $table->char('org_id',36);
            $table->unsignedTinyInteger('status')->index();
            $table->string('remarks',500);
            $table->char('created_by',36);
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
        Schema::dropIfExists('spm_school_plan');
    }
}
