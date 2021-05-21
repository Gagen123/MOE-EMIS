<?php

namespace App\Models\mess_manage;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FoodRelease extends Model
{
    use HasFactory, Uuid;
    protected $table="food_releases";

    protected $fillable = [
        'id',
        'dateOfrelease',
        'dzongkhag',
        'school',
        'quarter',
        'created_by',
        'updated_by'
    ];
}
