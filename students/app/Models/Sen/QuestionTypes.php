<?php

namespace App\Models\Sen;

use App\Models\Sen\Entity;
use App\Models\Sen\Question;
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

    public function entity(){
        return $this->belongsTo(Entity::class,'entity_type_id');
    }

    public function questions(){
        return $this->hasMany(Question::class,'question_types_id');
    }

    public function answerOptions(){
        return $this->hasManyThrough(
            'App\Models\Sen\AnswerOptions',
            Question::class,
            'question_types_id', 
            'question_id', 
            'id', 
            'id' 
        );
    }
}
