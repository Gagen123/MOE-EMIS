<?php

namespace App\Models;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrganizationIncomeFacilities extends Model
{
    use HasFactory, Uuid;
    protected $table="organization_income_facilities";
    protected $fillable = [
        'id',
        'organization_details_id',
        'incomeFacilitiesId',
        'amountGenerated',
        'date',
        'remarks'
    ];
}
