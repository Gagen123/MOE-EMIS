<?php

namespace App\Models\Sen;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{

    protected $table = 'sen_questions';
    public $timestamps = false;

    public $fillable = [
        'id',
        'questions',
        'question_types_id',
        'answer_data_type',
        'is_sub_question',
        'question_group_id',
        'display_order',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];
}
