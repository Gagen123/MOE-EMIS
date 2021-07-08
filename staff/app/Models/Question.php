<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuid;
class Question extends Model{
    use HasFactory, Uuid;
    protected $table="question_details";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'category_type_id',
        'leadership_type_id',
        'name',
        'answer_type',
        'display_order',
        'status',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];
}
