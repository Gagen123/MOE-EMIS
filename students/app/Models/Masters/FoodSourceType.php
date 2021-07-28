<?php

namespace App\Models\Masters;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FoodSourceType extends Model
{
    //
    use HasFactory, Uuid;
    protected $table="std_foodSource_type";

    protected $fillable = [
        'id',
        'Name', 
        'Description',
        'Status',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'

    ];
}
