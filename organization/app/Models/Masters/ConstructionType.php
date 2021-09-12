<?php

namespace App\Models\Masters;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ConstructionType extends Model
{
    //
    use HasFactory, Uuid;
    protected $table="master_construction_type";
    protected $fillable = [
        'id','name', 'code','description', 'status','created_by','updated_by','created_at','updated_at'
    ];
}
