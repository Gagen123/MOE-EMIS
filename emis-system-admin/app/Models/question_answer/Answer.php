<?php

namespace App\Models\question_answer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuid;
class Answer extends Model{
    use HasFactory, Uuid;
    protected $table="question_answers";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'parent_id',
        'name',
        'status',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];
}
