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
        'id','organizationId','categoryId','subCategoryId','structureNo','yearOfConstruction',
        'plintchArea','noOfFloor','totalCapacity','rampAccess','presentCondition','design'
    ];
}
