<?php

namespace App\Models\establishment;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ApplicationEstPrivate extends Model
{
    use HasFactory, Uuid;
    protected $table="application_est_private";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'ApplicationDetailsId',
        'proposedName',
        'levelId',
        'proprietorName',
        'proprietorCid',
        'proprietorPhone',
        'proprietorMobile',
        'proprietorEmail',
        'totalLand',
        'enrollmentBoys',
        'enrollmentGirls',
        'proposedLocation',
        'proposedInfrastructure',
        'typeOfSchool',
        'coLocatedParent',
        'parentSchool',
    ];
}
