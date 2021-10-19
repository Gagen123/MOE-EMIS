<?php

namespace App\Models\staff_leadership;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
class QuestionCategory extends Model{
    use HasFactory, Uuid;
    protected $table="master_question_category";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'name',
        'code',
        'description',
        'status',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
    ];
}
