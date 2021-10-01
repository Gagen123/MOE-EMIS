<?php

namespace App\Models\academics;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RemedialClassDetail extends Model
{
    use HasFactory, Uuid;
    protected $table="aca_remedial_classes_detail";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'aca_remedial_class_id',
        'std_student_id',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
    ];
}
