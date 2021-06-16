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
        'module_id',
        'service_id',
        'name',
        'code',
        'status',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];
    public function module() {
        return $this->belongsTo(Module::class, 'module_id');
    }
    public function service() {
        return $this->belongsTo(Service::class, 'service_id');
    }
    // public function module(){
    //     return $this->hasOneThrough(Module::class,Service::class,'id','id','service_id','service_id');
    // }
}
