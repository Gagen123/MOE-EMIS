<?php

namespace App\Models\establishment;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ApplicationEstBifurcation extends Model
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
        'initiated_by',
        'dateOfBifurcation'
    ];
}
