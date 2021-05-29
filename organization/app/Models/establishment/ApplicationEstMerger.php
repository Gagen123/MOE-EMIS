<?php

namespace App\Models\establishment;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ApplicationEstMerger extends Model
{
    use HasFactory, Uuid;
    protected $table="application_est_merger";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'ApplicationDetailsId',
        'OldOrganizationId',
        'OldOrganizationId2',
        'proposedName',
        'initiated_by',
        'levelId',
        'locationId',
        'isGeoPoliticallyLocated',
        'isSenSchool',
        'isFeedingSchool',
        'locationTypeId'
    ];
}
