<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AcaRemedialClassesDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aca_remedial_classes_detail', function (Blueprint $table) {
            $table->char('id',36)->primary();
            $table->char('aca_remedial_class_id',36)->index();
            $table->char('std_student_id',36)->index();
            $table->string('created_by',36)->index();
            $table->string('updated_by',36)->index()->nullable();
            $table->timestamps();

            $table->foreign('aca_remedial_class_id')->references('id')->on('aca_remedial_classes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aca_remedial_classes_detail');
    }
}
