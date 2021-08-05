<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class StudentGuardian extends Model
{
    use HasFactory, Uuid;
    public $timestamps = false;
    protected $table="std_admission_guardian";
    protected $fillable = [
        'id',
        'StdStudentId',
        'ContactType',
        'CmnNationalityId',
        'CidNo',
        'Name',
        'CmnPermanentGewogId',
        'CmnPermanentChiwogId',
        'CmnPresentGewogId',
        'CmnPresentChiwogId',
        'WorkAddress',
        'ResidenceAddress',
        'CmnOccupationId',
        'Email',
        'ContactNo',
        'Relationship',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];
}
