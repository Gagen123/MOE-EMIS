<?php

namespace App\Models\Students;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class StudentGuardainDetails extends Model
{
    use HasFactory, Uuid;
    public $timestamps = false;
    protected $table="std_guardain_detils";
    protected $fillable = [
        'id',
        'student_id',
        'contact_type',
        'nationality',
        'cid_passport',
        'name',
        'present_village_id',
        'village_id',
        'address',
        'work_address',
        'residence_address',
        'occupation',
        'email',
        'cntct_no',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];
}
