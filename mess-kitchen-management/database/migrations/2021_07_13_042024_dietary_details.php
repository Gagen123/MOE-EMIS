<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DietaryDetails extends Migration{
    public function up(){
        Schema::create('dietary_detail_info', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('basic_id',36)->nullable(false);
            $table->char('dietary_date_id',36)->nullable(false);
            $table->char('meal_type',36)->nullable(false);
            $table->char('cereal',4)->nullable();
            $table->char('root',4)->nullable();
            $table->char('veg',4)->nullable();
            $table->char('meat',4)->nullable();
            $table->char('egg',4)->nullable();
            $table->char('fish',4)->nullable();
            $table->char('pulse',4)->nullable();
            $table->char('milk',4)->nullable();
            $table->char('fruit',4)->nullable();
            $table->char('oil',4)->nullable();
            $table->char('sugar',4)->nullable();
            $table->char('chilli',4)->nullable();

            // $table->char('b_cereal',4)->nullable();
            // $table->char('b_root',4)->nullable();
            // $table->char('b_veg',4)->nullable();
            // $table->char('b_meat',4)->nullable();
            // $table->char('b_egg',4)->nullable();
            // $table->char('b_fish',4)->nullable();
            // $table->char('b_pulse',4)->nullable();
            // $table->char('b_milk',4)->nullable();
            // $table->char('b_fruit',4)->nullable();
            // $table->char('b_oil',4)->nullable();
            // $table->char('b_sugar',4)->nullable();
            // $table->char('b_chilli',4)->nullable();
            // $table->char('l_cereal',4)->nullable();
            // $table->char('l_root',4)->nullable();
            // $table->char('l_veg',4)->nullable();
            // $table->char('l_meat',4)->nullable();
            // $table->char('l_egg',4)->nullable();
            // $table->char('l_fish',4)->nullable();
            // $table->char('l_pulse',4)->nullable();
            // $table->char('l_milk',4)->nullable();
            // $table->char('l_fruit',4)->nullable();
            // $table->char('l_oil',4)->nullable();
            // $table->char('l_sugar',4)->nullable();
            // $table->char('l_chilli',4)->nullable();
            // $table->char('t_cereal',4)->nullable();
            // $table->char('t_root',4)->nullable();
            // $table->char('t_veg',4)->nullable();
            // $table->char('t_meat',4)->nullable();
            // $table->char('t_egg',4)->nullable();
            // $table->char('t_fish',4)->nullable();
            // $table->char('t_pulse',4)->nullable();
            // $table->char('t_milk',4)->nullable();
            // $table->char('t_fruit',4)->nullable();
            // $table->char('t_oil',4)->nullable();
            // $table->char('t_sugar',4)->nullable();
            // $table->char('t_chilli',4)->nullable();
            // $table->char('d_cereal',4)->nullable();
            // $table->char('d_root',4)->nullable();
            // $table->char('d_veg',4)->nullable();
            // $table->char('d_meat',4)->nullable();
            // $table->char('d_egg',4)->nullable();
            // $table->char('d_fish',4)->nullable();
            // $table->char('d_pulse',4)->nullable();
            // $table->char('d_milk',4)->nullable();
            // $table->char('d_fruit',4)->nullable();
            // $table->char('d_oil',4)->nullable();
            // $table->char('d_sugar',4)->nullable();
            // $table->char('d_chilli',4)->nullable();
        });
    }
    public function down(){
        Schema::dropIfExists('dietary_detail_info');
    }
}
