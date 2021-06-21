<?php

namespace App\Models\establishment;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ApplicationEstClosure extends Model
{
    use HasFactory, Uuid;
    protected $table="application_est_closure";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'ApplicationDetailsId',
        'organizationId',
        'remarksForClosure',
        'remark',
        'dateOfClosure'
    ];
}
