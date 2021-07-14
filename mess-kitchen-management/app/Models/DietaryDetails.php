<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class DietaryDetails extends Model{
    use HasFactory, Uuid;
    public $timestamps = false;
    protected $table="dietary_detail_info";
    protected $fillable = [
        'id',
        'basic_id',
        'dietary_date_id',
        'meal_type',
        'cereal',
        'root',
        'veg',
        'meat',
        'egg' ,
        'fish' ,
        'pulse' ,
        'milk',
        'fruit',
        'oil',
        'sugar',
        'chilli',

        // 'b_cereal',
        // 'b_root',
        // 'b_veg',
        // 'b_meat',
        // 'b_egg' ,
        // 'b_fish' ,
        // 'b_pulse' ,
        // 'b_milk',
        // 'b_fruit',
        // 'b_oil',
        // 'b_sugar',
        // 'b_chilli',
        // 'l_cereal',
        // 'l_root',
        // 'l_veg',
        // 'l_meat',
        // 'l_egg',
        // 'l_fish',
        // 'l_pulse',
        // 'l_milk',
        // 'l_fruit',
        // 'l_oil',
        // 'l_sugar',
        // 'l_chilli',
        // 't_cereal',
        // 't_root',
        // 't_veg',
        // 't_meat',
        // 't_egg',
        // 't_fish',
        // 't_pulse',
        // 't_milk',
        // 't_fruit',
        // 't_oil',
        // 't_sugar',
        // 't_chilli',
        // 'd_cereal',
        // 'd_root',
        // 'd_veg',
        // 'd_meat',
        // 'd_egg',
        // 'd_fish',
        // 'd_pulse',
        // 'd_milk',
        // 'd_fruit',
        // 'd_oil',
        // 'd_sugar',
        // 'd_chilli',
    ];
}
