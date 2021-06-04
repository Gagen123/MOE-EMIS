<?php

namespace App\Models\generalInformation;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Income extends Model
{
    use HasFactory, Uuid;
    protected $table="organization_income_facilities";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'organization_details_id',
        'incomeFacilitiesId',
        'amountGenerated',
        'date',
        'remarks'
    ];
}
