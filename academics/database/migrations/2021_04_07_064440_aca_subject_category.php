<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Database\Seeders\SubjectCategorySeeder;
use Illuminate\Database\Migrations\Migration;

class AcaSubjectCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aca_subject_category', function (Blueprint $table) {
            $table->char('id',36)->primary();
            $table->string('name',100)->unique();
            $table->string('code',10)->index();
            $table->string('dzo_name',255)->nullable();
            $table->unsignedTinyInteger('display_order')->index();
            $table->unsignedTinyInteger('status')->index()->default(1)->comment('0-Disabled');
            $table->string('created_by',36)->index();
            $table->string('updated_by',36)->index()->nullable();
            $table->timestamps();
        });

        $seeder = new SubjectCategorySeeder();
        $seeder->run();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aca_subject_category');
    }
}
