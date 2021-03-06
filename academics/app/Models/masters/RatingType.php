<?php

namespace App\Models\masters;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuid;

class RatingType extends Model
{
    use HasFactory, Uuid;
    protected $table="aca_rating_type";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'name',
        'description',
        'status', 
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
    ];
}
