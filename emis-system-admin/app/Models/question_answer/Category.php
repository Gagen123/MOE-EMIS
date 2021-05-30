<?php

namespace App\Models\question_answer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuid;
class Category extends Model{
    use HasFactory, Uuid;
    protected $table="question_category";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'parent_id',
        'name',
        'code',
        'status',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];
    public function service() {
        return $this->belongsTo(Service::class, 'parent_id');
    } 
    public function module(){
        return $this->hasOneThrough(Module::class,Service::class,'id','id','parent_id','parent_id'); 
    }
}
