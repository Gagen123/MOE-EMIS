<?php

namespace App\Models\academics;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentElectiveSubjectHistory extends Model
{
    use HasFactory, Uuid;
    protected $table="aca_std_optional_sub_history";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'std_student_id',
        'aca_sub_id',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
        'recorded_for'
    ];
}
