<?php

namespace App\Models\Students;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class StudentClassDetails extends Model
{
    use HasFactory, Uuid;
    public $timestamps = false;
    protected $table="std_class_detils";
    protected $fillable = [
        'id',
        'student_id',
        'dzo_id',
        'org_id',
        'class_stream_id',
        'section',
        'student_type',
        'no_meals',
        'scholarship',
        'special_benifit',
        'disability',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];
}