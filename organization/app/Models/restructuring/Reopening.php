<?php

namespace App\Models\restructuring;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reopening extends Model
{
    use HasFactory, Uuid;
    protected $table="application_est_reopening";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */ 
    protected $fillable = [
        'id',
        'ApplicationDetailsId',
        'organizationId',
        'levelId',
        'initiated_by',
        'dateOfReopening',
        'proposedName',
        'locationId',
        'isGeoPoliticallyLocated',
        'isSenSchool',
        'isFeedingSchool',
        'locationTypeId',
        'proposedLocation',
        'created_by',
        'updated_by'
    ]; 
}
