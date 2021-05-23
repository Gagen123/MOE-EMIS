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
        'service_id',
        'category_id',
        'category_type_id',
        'name',
        'answer_type',
        'status',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];
    public function category() {
        return $this->belongsTo(Category::class, 'category_id')->select('id','name');
    } 
    public function service() {
        return $this->belongsTo(Service::class,'service_id')->select('id','parent_id','name');
    } 
    public function categorytype() {
        return $this->belongsTo(CategoryType::class,'category_type_id')->select('id','name');
    }
}
