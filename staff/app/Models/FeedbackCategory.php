<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuid;
class FeedbackCategory extends Model
{
    use HasFactory, Uuid;
    protected $table="staff_leadership_feedback_category";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'name',
        'status',
        'type',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];
}
