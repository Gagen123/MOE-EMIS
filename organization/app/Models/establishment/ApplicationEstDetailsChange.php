<?php

namespace App\Models\establishment;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ApplicationEstDetailsChange extends Model
{
    use HasFactory, Uuid;
    protected $table="application_est_details_change";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'ApplicationDetailsId',
        'organizationId',
        'change_type',
        'category',
        'subCategory',
        'constructionType',
        'structureNo',
        'proposedChange',
        'proposedLocation',
        'coLocatedParent',
        'parentSchoolId',
        'initiatedBy',
        'changeInDetails'

    ];
}
