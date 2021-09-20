<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AcaRemedialClasses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aca_remedial_classes', function (Blueprint $table) {
            $table->char('id',36)->primary();
            $table->char('org_id',36)->index();
            $table->char('org_class_id',36)->index();
            $table->char('org_stream_id',36)->index()->nullable();
            $table->char('org_section_id',36)->index()->nullable();
            $table->char('aca_sub_id',36)->index();
            $table->char('stf_staff_id',36)->index();
            $table->string('class_stream_section',100);
            $table->date('from_date')->index();
            $table->date('to_date')->index();
            $table->smallInteger('total_no_of_hours');
            $table->string('time',100);
            $table->string('remarks',100)->nullable();
            $table->string('created_by',36)->index()->nullable();
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
        Schema::dropIfExists('aca_remedial_classes');
    }
}
