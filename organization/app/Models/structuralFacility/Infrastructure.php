<?php

namespace App\Models\structuralFacility;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Infrastructure extends Model
{
    use HasFactory, Uuid;
    protected $table="infrastructures";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'organizationId',
        'categoryId',
        'subCategoryId',
        'constructionType',
        'structureNo',
        'yearofconstructinNo',
        'plintchArea',
        'noOfFloor',
        'totalCapacity',
        'rampAccess',
        'presentCondition',
        'design',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
    ];
}
