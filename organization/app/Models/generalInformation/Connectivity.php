<?php

namespace App\Models\generalInformation;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Connectivity extends Model
{
    use HasFactory, Uuid;
    protected $table="connectivities";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','organizationId','roadTypeId','distanceFromRoad','daysFromRoad','hoursFromRoad','electricitySourceId',
        'electricitySupplyId','hasElectricalSubstation','telephoneServiceProvoderId','internetServiceProviderId',
        'mbps','drukRenConnection'
    ];
}
