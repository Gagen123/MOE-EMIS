<?php

namespace App\Models\Students;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CeaStudentAward extends Model
{
    use HasFactory, Uuid;
    protected $table="cea_student_award";

    protected $fillable = [
        'id',
        'StdStudentId',
        'CeaAwardId',
        'AwardDate',
        'AwardedBy',
        'Place',
        'Remarks'
    ];

    public function students(){
        return $this->belongsTo(Student::class,'StdStudentId');
    }
}
