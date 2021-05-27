<?php

namespace App\Models\establishment;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ApplicationNoMeals extends Model
{
    
    use HasFactory, Uuid;
    protected $table="application_no_meals";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'foreignKeyFor',
        'foreignKeyId',
        'noOfMeals'
    ];
}
