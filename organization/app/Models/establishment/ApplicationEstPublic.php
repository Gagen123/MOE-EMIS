<?php

namespace App\Models\establishment;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ApplicationEstPublic extends Model
{
    use HasFactory, Uuid;
    protected $table="application_est_public";
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'ApplicationDetailsId',
        'proposedName',
        'initiated_by',
        'parentAgency',
        'levelId',
        'locationId',
        'isGeoPoliticallyLocated',
        'isSenSchool',
        'isFeedingSchool',
        'coLocatedParent',
        'parentSchool',
        'locationTypeId',
        'proposedLocation',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
    ];


}
