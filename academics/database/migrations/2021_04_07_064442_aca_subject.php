<?php

use Database\Seeders\SubjectSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class AcaSubject extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aca_subject', function (Blueprint $table) {
            $table->char('id', 36)->primary();
            $table->char('aca_sub_category_id', 36)->index();
            $table->char('aca_sub_id', 36)->nullable()->index();
            $table->string('name', 100)->unique();
            $table->string('code', 10)->index();
            $table->string('dzo_name', 1000)->nullable();
            $table->unsignedTinyInteger('assessed_by_class_teacher')->index()->default(0);
            $table->unsignedTinyInteger('display_order')->index();
            $table->unsignedTinyInteger('status')->index()->default(1)->comment('0-Disabled');
            $table->string('created_by', 36)->index();
            $table->string('updated_by', 36)->index()->nullable();
            $table->timestamps();
        });
        $seeder = new SubjectSeeder();
        $seeder->run();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aca_subject');
    }
}
