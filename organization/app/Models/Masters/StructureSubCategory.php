<?php

namespace App\Models\Masters;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StructureSubCategory extends Model
{
    use HasFactory, Uuid;
    protected $table="structure_sub_categories";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','structureCategory','subCategoryName', 'description', 'status','created_by','updated_by'
    ];
}
