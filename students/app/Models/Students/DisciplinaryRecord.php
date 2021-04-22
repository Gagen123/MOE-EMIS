<?php

namespace App\Models\Students;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DisciplinaryRecord extends Model
{
    use HasFactory, Uuid;
    protected $table="std_student_disciplinary";

    protected $fillable = [
        'id',
        'OrgOrganizationId',
        'StdStudentId',
        'StdDisciplinaryOffenceTypeId',
        'StdDisciplinarySeverityId',
        'OffenceDate',
        'OffenceDescription',
        'StdDisciplinaryActionTypeId',
        'ActionDescription'
    ];

    public function students(){
        return $this->belongsTo(Student::class,'StdStudentId');
    }
}
