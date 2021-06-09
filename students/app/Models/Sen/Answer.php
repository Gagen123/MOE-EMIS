<?php

namespace App\Models\Sen;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Answer extends Model
{
    use HasFactory,Uuid;
    public $timestamps = false;
    protected $table="sen_answers";
    protected $fillable = [
        'id',
        'org_id',
        'staff_id',
        'student_id',
        'question_id',
        'answer_id',
        'answer',
        'remarks',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'sen_data_config_id'
    ];
}
