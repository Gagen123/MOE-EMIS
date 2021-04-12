<?php

namespace App\Models\structuralFacility;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FacilityInStructure extends Model
{
    use HasFactory, Uuid;
    protected $table="infrastructure_facilities";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','infrastructureId','facilityTypeId','facilityName','capacity',
        'noOfFacility','noAccessibleToDisabled','noWithInternetConnection'
    ];
}
