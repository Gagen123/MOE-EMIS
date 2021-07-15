<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuid;
class Answer extends Model
{
    use HasFactory, Uuid;
    protected $table="answer_details";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'question_id',
        'name',
        'status',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];
}
