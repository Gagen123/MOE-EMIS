<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AcaYearlyResult extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aca_yearly_result', function (Blueprint $table) {
            $table->char('id',36)->primary();
            $table->char('org_id',36)->index();
            $table->string('school_name',50);
            $table->unsignedSmallInteger('gewog_id')->index();
            $table->string('gewog',50);
            $table->unsignedSmallInteger('dzon_id')->index();
            $table->string('dzongkhag',50);
            $table->char('org_class_id',36)->index();
            $table->char('org_stream_id',36)->nullable()->index();
            $table->char('org_section_id',36)->nullable()->index();
            $table->string('stf_class_tecaher_name',100);
            $table->string('stf_principal_name',100);
            $table->char('created_by',36)->nullable()->index();
            $table->string('updated_by',36)->index()->nullable();
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
        Schema::dropIfExists('aca_yearly_result');
    }
}
