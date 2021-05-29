<?php

namespace App\Models\Masters;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ElectricitySupply extends Model
{
    use HasFactory, Uuid;
    protected $table="electricity_supplies";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','name', 'description','status','created_by','updated_by'
    ];
}
