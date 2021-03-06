<?php

namespace App\Models\Masters;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StructureSubCategory extends Model
{
    use HasFactory, Uuid;
    protected $table="master_structure_sub_categories";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','structureCategory','name','code', 'description', 'status','created_by','updated_by'
    ];
}
