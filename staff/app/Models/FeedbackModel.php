<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuid;
class FeedbackModel extends Model{
    use HasFactory, Uuid;
    protected $table="staff_feedback_details";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'feedback_provider_id',
        'questionId',
        'selection_type_id',
        'position_title_id',
        'ans_type',
        'answer',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];
}
