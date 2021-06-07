<?php

namespace App\Models\restructuring;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bifurcation extends Model
{
    use HasFactory, Uuid;
    protected $table="application_est_bifurcation";

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
        'dateOfBifurcation',
        'proposedName',
        'locationId',
        'isGeoPoliticallyLocated',
        'isSenSchool',
        'isFeedingSchool',
        'locationTypeId',
        'proposedLocation'
    ]; 
}
