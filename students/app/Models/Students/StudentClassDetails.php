<?php

namespace App\Models\Students;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class StudentClassDetails extends Model
{
    use HasFactory, Uuid;
    public $timestamps = false;
    protected $table="std_student_school_detail";
    protected $fillable = [
        'id',
        'StdStudentId',
        'StudentCode',
        'Dzo_Id',
        'Org_Id',
        'OrgClassId',
        'OrgClassSectionId',
        'StdStudentTypeId',
        'NoOfMeals',
        'IsSenStudent',
        'Meal_Type',
        'Feeding_Type',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'

    ];
}
