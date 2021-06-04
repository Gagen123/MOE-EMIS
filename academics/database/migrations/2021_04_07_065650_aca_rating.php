<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Database\Seeders\RatingSeeder;

class AcaRating extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aca_rating', function (Blueprint $table) {
            $table->char('id',36)->primary();
            $table->char('aca_rating_type_id',36)->index();
            $table->string('name',100)->unique();
            $table->string('dzo_name',255)->nullable();
            $table->tinyInteger('score');
            $table->unsignedTinyInteger('status')->index()->default(1)->comment('0-Disabled');
            $table->string('created_by',36)->index();
            $table->string('updated_by',36)->index()->nullable();
            $table->timestamps();

            $table->foreign('aca_rating_type_id')->references('id')->on('aca_rating_type');

        });
        $seeder = new RatingSeeder();
        $seeder->run();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aca_rating');
    }
}
