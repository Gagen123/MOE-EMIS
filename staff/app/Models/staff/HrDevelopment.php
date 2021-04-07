<?php

namespace App\Models\staff;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
class HrDevelopment extends Model{
    use HasFactory, Uuid;
    protected $table="staff_program_details";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'training_type',
        'course_title',
        'organizer',
        'start_date',
        'end_date',
        'related_programme',

        'category',
        'donor_agency',
        'projectofdonor',
        'study_country',
        'coursemode',
        'degree',
        'subject1',
        'subject2',
        'thesis_title',

        'programme_level',
        'programme_type',
        'course_type',
        'course_provider',
        'vanue',
        'total_budget',
        'total_hrs',
        'financial_source',

        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
        'status'
    ];
}
