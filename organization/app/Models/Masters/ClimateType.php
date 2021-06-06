<?php

namespace App\Models\Masters;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClimateType extends Model
{
    use HasFactory, Uuid;
    protected $table="master_climate_type";
    protected $fillable = [
        'id','name', 'description', 'status','created_by','updated_by','created_at','updated_at'
    ];
}
