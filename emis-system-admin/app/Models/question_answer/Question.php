<?php

namespace App\Models\question_answer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuid;
class Question extends Model{
    use HasFactory, Uuid;
    protected $table="question_details";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'parent_id',
        'name',
        'answer_type',
        'code',
        'status',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];
    public function category() {
        return $this->belongsTo(Category::class, 'parent_id');
    } 
    public function service() {
        return $this->hasOneThrough(Service::class,Category::class,'id','id','parent_id','parent_id');
    } 
    
}
