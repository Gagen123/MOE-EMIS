<?php

namespace App\Models\staff;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class StaffHistory extends Model{
    use HasFactory;
    protected $table="stf_staff_history";
    public $timestamps = false;
    protected $fillable = [
        'record_id',
        'id',
        'emp_type_id',
        'emp_id',
        'name',
        'cid_work_permit',
        'position_title_id',
        'sex_id',
        'dob',
        'working_agency_id',
        'merital_status',
        'country_id',
        'dzo_id',
        'geowg_id',
        'village_id',
        'address',
        'email',
        'alternative_email',
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
        'status',
        'inserted_at',
        'inserted_by',
        'inserted_for',
        'inserted_application_no',
    ];
}
