<?php

namespace App\Models\question_answer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuid;
class Service extends Model{
    use HasFactory, Uuid;
    protected $table="question_service";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'module_id',
        'name',
        'code',
        'status',
        'type',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];
    public function module() {
        return $this->belongsTo(Module::class, 'module_id');
    }
}
