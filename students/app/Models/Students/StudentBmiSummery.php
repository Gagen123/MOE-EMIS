<?php

namespace App\Models\Students;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentBmiSummery extends Model{
    use HasFactory, Uuid;
    public $timestamps = false;
    protected $table="std_student_bmi_summary";
    protected $fillable = [
        'id',
        'term_id',
        'date',
        'class_id',
        'stream_id',
        'section_id',
        'remarks',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
    ];
}
