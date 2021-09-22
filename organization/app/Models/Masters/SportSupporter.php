<?php

namespace App\Models\Masters;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SportSupporter extends Model
{
    use HasFactory, Uuid;
    protected $table = "master_sport_supporter";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','name','code', 'description','status','created_by','updated_by'
    ];
}
