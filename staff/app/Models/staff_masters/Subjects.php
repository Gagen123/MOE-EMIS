<?php

namespace App\Models\staff_masters;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuid;

class Subjects extends Model
{
    use HasFactory, Uuid;
    protected $table="master_stf_subject";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'sub_area_id',
        'name',
        'code',
        'status',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];

    public function subjectArea() {
        return $this->belongsTo(StaffSubjectArea::class, 'sub_area_id');
    }
}
