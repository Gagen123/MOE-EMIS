<?php

namespace App\Models\establishment;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ApplicationVerification extends Model
{
    use HasFactory, Uuid;
    protected $table="application_verification";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'type',
        'ApplicationDetailsId',
        'department_id',
        'verifyingAgency',
        'tentativeDate',
        'remarks',
        'updated_by',
        'created_by',
        'created_at',
        'updated_at'
    ];
}
