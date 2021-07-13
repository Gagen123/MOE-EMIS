<?php

namespace App\Models\Students;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentGuardianDetails extends Model
{
    use HasFactory, Uuid;
    public $timestamps = false;
    protected $table="std_student_guardian";
    protected $fillable = [
        'id',
        'StdStudentId',
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
        'ContactNo',
        'Email',
        'Relationship',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
        
    ];
}
