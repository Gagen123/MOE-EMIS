<?php

namespace App\Models\Masters;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FurnitureUsage extends Model
{
    use HasFactory, Uuid;
    protected $table = "master_furniture_usage";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','name','code','description','status','created_by','updated_by'
    ];
}
