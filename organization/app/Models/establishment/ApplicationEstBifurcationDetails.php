<?php

namespace App\Models\establishment;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ApplicationEstBifurcationDetails extends Model
{
    use HasFactory, Uuid;
    protected $table="application_est_bifurcation_details";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [   
        'id',
        'ApplicationEstBifurcationId',
        'proposedName',
        'levelId',
        'locationId',
        'isGeoPoliticallyLocated',
        'isSenSchool',
        'isFeedingSchool',
        'locationTypeId',
        'proposedLocation'
    ];
}
