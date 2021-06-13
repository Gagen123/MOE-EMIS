<?php

namespace App\Models\Sen;

use App\Traits\Uuid;
use App\Models\Sen\Question;
use App\Models\Sen\DataConfig;
use App\Models\Sen\AnswerOption;
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
        'sen_data_config_id',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
    ];

    // public function org(){
    //     return $this->belongsTo(Orgs::class, 'org_id');
    // }

    public function question(){
        return $this->belongsTo(Question::class, 'question_id', 'id');
    }

    public function answerOption(){
        return $this->belongsTo(AnswerOption::class, 'answer_id', 'id');
    }

    public function dataConfig(){
        return $this->belongsTo(DataConfig::class, 'sen_data_config_id', 'id');
    }
}
