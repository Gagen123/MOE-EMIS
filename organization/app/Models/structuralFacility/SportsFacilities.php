<?php

namespace App\Models\structuralFacility;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class SportsFacilities extends Model
{
    //
    use HasFactory, Uuid;
    protected $table="organization_sports_facilities";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'facilityId', 'yearOfEstablishment', 'supportedBy','facilityTypeId',
        'size_area',  'created_by',
        'updated_by', 'created_at', 'updated_at'
    ];
}
