<?php

namespace App\Models\Students;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CeaStudentRole extends Model
{
    use HasFactory, Uuid;
    protected $table="cea_role_student";

    protected $fillable = [
        'id',
        'StdStudentId',
        'CeaRoleId',
        'Remarks'
    ];

    public function students(){
        return $this->belongsTo(Student::class,'StdStudentId');
    }

}
