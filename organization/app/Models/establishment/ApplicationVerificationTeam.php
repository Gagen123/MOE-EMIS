<?php

namespace App\Models\establishment;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ApplicationVerificationTeam extends Model
{
    use HasFactory, Uuid;
    protected $table="application_verification_team";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'ApplicationVerificationId',
        'agency',
        'teamMember',
        'verificationDate',
        'remarks',
        'updated_by',
        'created_by',
        'created_at',
        'updated_at'
    ];
}
