<?php

namespace App\Models\Sen;

use Illuminate\Database\Eloquent\Model;

class QuestionTypes extends Model
{
    protected $table = 'sen_question_types';
    public $timestamps = false;

    public $fillable = [
        'id',
        'name',
        'entity_type_id'
    ];

}
