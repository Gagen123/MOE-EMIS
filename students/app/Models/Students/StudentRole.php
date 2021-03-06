<?php

namespace App\Models\Students;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentRole extends Model
{
    use HasFactory, Uuid;
    protected $table="std_role_student";

    protected $fillable = [
        'id',
        'StdStudentId',
        'StdRoleId',
        'created_by',
        'created_at',
        'Remarks',
        'Status'
    ];

    public function students(){
        return $this->belongsTo(Student::class,'StdStudentId');
    }

}
