<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StructureFacility extends Model
{
    use HasFactory, Uuid;
    protected $table="structure_facilities";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','structureId','structureFacilityId','facilityNo','capacity','noOfFacility',
        'accessibleToDisabled','internetConnection',
    ];
}
