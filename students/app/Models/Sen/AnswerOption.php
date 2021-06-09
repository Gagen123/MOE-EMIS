<?php

namespace App\Models\Sen;

use App\Traits\Uuid;
use App\Models\Sen\Question;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AnswerOption extends Model
{
    use HasFactory,Uuid;
    public $timestamps = false;
    protected $table="sen_answer_options";
    protected $fillable = [
        'id',
        'answer',
        'question_id',
        'can_hav_remarks',
    ];

    public function question(){
        return $this->belongsTo(Question::class,'question_id', 'id');
    }
}
