<?php

namespace App\Models\Masters;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StructureDesigner extends Model
{
    use HasFactory, Uuid;
    protected $table="structure_designers";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','name', 'description', 'status','created_by','updated_by'
    ];
}
