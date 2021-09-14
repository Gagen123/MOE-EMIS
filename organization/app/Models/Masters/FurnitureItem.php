<?php

namespace App\Models\Masters;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FurnitureItem extends Model 
{
    use HasFactory, Uuid;
    protected $table="master_furniture_item";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','furnitureType','code','name','description','status','created_by','updated_by'
    ];
}
