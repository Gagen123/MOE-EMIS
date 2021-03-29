<?php

namespace App\Models\staff;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class PersonalDetails extends Model{
    use HasFactory, Uuid;
    protected $table="stf_staff";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'emp_type_id',
        'name',
        'cid_work_permit',
        'position_title_id',
        'sex_id',
        'dob',
        'working_agency_id',
        'merital_status',
        'country_id',
        'village_id',
        'address',
        'email',
        'contact_no',
        'comp_sub_id',
        'elective_sub_id1',
        'elective_sub_id2',
        'cureer_stagge_id',
        'employee_code',
        'remarks',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
        'status'
    ];

}
