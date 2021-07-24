<?php

use Database\Seeders\PromotionSubjectGroup;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AcaPromotionRule extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aca_promotion_rule', function (Blueprint $table) {
            $table->char('id',36)->primary();
            $table->char('org_class_id',36)->index();
            $table->char('org_stream_id',36)->index()->nullable();
            $table->char('aca_sub_id',36)->index();
            $table->tinyInteger('aca_promotion_sub_group_id')->index();
            $table->string('created_by',36)->index();
            $table->string('updated_by',36)->index()->nullable();
            $table->timestamps();

            $table->foreign('aca_promotion_sub_group_id')->references('id')->on('aca_promotion_sub_group')->onDelete('cascade');

        });
        $seeder = new PromotionSubjectGroup;
        $seeder->run();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aca_promotion_rule');
    }
}
