<?php

namespace App\Models\Sen;

use App\Models\Sen\Answer;
use App\Models\Sen\AnswerOption;
use App\Models\Sen\QuestionTypes;
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

    public function questionType(){
        return $this->belongsTo(QuestionTypes::class,'question_types_id');
    }
    
    public function answerOptions()
    {
        return $this->hasMany(AnswerOption::class, 'question_id', 'id');
    }

    public function questionAnswers()
    {
        return $this->hasMany(Answer::class, 'question_id', 'id');
    }
}
