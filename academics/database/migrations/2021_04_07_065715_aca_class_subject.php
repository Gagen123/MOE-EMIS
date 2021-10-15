<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AcaClassSubject extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aca_class_subject', function (Blueprint $table) {
            $table->char('id',36)->primary();
            $table->char('org_class_id',36)->index();
            $table->char('org_stream_id',36)->nullable()->index();
            $table->char('aca_sub_id',36)->index();
            $table->char('aca_rating_type_id',36)->index();
            $table->string('class_stream',100);
            $table->decimal('pass_score',6,2)->nullable();
            $table->unsignedTinyInteger('is_elective')->index()->default(0)->comment('1-Subject is elective for the class');
            $table->unsignedTinyInteger('show_in_result')->index()->default(1);
            $table->unsignedTinyInteger('display_order')->index();
            $table->string('created_by',36)->index();
            $table->string('updated_by',36)->index()->nullable();
            $table->timestamps();
        
            $table->unique(['org_class_id', 'org_stream_id', 'aca_sub_id'],'unique_class_stream_sub');
            $table->foreign('aca_sub_id')->references('id')->on('aca_subject')->onDelete('cascade');
            $table->foreign('aca_rating_type_id')->references('id')->on('aca_rating_type')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aca_class_subject');
    }
}
