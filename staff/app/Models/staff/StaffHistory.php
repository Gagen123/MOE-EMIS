<?php

namespace App\Models\staff;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class StaffHistory extends Model{
    use HasFactory;
    protected $table="stf_staff_history";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'record_id',
        'position_title_id',
        'working_agency_id',
        'merital_status',
        'dzo_id',
        'geowg_id',
        'village_id',
        'comp_sub_id',
        'elective_sub_id1',
        'elective_sub_id2',
        'cureer_stagge_id',
        'remarks',
        'inserted_at',
        'inserted_by',
        'inserted_for',
        'inserted_application_no',
    ];
}
