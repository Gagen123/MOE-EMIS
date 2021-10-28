<?php

namespace App\Models\Masters;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FoodSourceType extends Model
{
    //
    use HasFactory, Uuid;
    protected $table="std_foodsource_type";

    protected $fillable = [
        'id',
        'Name', 
        'Description', 
        'Code',
        'status'
    ];
}


