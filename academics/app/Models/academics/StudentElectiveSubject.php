<?php

namespace App\Models\academics;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentElectiveSubject extends Model
{
    use HasFactory, Uuid;
    protected $table="aca_student_elective_subject";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'std_student_id',
        'aca_sub_id',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
    ];
}
