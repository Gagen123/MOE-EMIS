<?php

namespace App\Models\Masters;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MastersAccessible extends Model

{
    use HasFactory, Uuid;
    protected $table="accessible_type";
    protected $fillable = [
        'id','name', 'description','code',
         'status','created_by','updated_by','created_at','updated_at'
    ];
}
