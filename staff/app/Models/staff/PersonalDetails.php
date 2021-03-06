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
        'zest_staff_id',
        'emp_id',
        'name',
        'cid_work_permit',
        'contract_category',
        'position_title_id',
        'position_sub_level_id',
        'sex_id',
        'dob',
        'working_agency_id',
        'merital_status',
        'country_id',
        'p_dzongkhag',
        'p_gewog',
        'p_village',
        'dzo_id',
        'geowg_id',
        'village_id',
        'org_level',
        'address',
        'email',
        'alternative_email',
        'contact_no',
        'comp_sub_id',
        'elective_sub_id1',
        'elective_sub_id2',
        'cureer_stagge_id',
        'is_sen',
        'is_trained_in_sen',
        'initial_appointment_date',
        'employee_code',
        'remarks',
        'sen_remarks',
        'currier_stage_remarks',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
        'status'
    ];

}
