<?php

namespace App\Models\academics;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClassTeacher extends Model
{
    use HasFactory, Uuid;
    protected $table="aca_class_teacher";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'org_id',
        'org_class_id',
        'org_stream_id',
        'org_section_id',
        'stf_staff_id',
        'class_stream_section',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
    ];
    
}
