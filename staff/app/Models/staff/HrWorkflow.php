<?php

namespace App\Models\staff;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class HrWorkflow extends Model{
    use HasFactory, Uuid;
    protected $table="staff_program_workflow";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'program_id',
        'sequence',
        'authority_type',
        'sys_role_id',
    ];
    public function with_program() {
        return $this->belongsTo(HrDevelopment::class, 'program_id');
    }
}
