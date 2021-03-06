<?php

namespace App\Models\staff_masters;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuid;

class Qualification extends Model
{
    use HasFactory, Uuid;
    protected $table="master_stf_qualification";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'name',
        'description',
        'q_type_id',
        'q_level_id',
        'code',
        'status',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];
    public function quialificationtype() {
        return $this->belongsTo(QualificationType::class, 'q_type_id');
    }
    public function quialificationlevel() {
        return $this->belongsTo(QualificationLevel::class, 'q_level_id');
    }
}
