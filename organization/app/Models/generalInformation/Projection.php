<?php

namespace App\Models\generalInformation;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Projection extends Model
{
    use HasFactory, Uuid;
    protected $table="organization_projections";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'organizationId',
        'class',
        'academicYear',
        'ProjectionNo',
        'remarks',
    ];
}
