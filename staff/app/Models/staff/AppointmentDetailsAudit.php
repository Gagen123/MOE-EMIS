<?php

namespace App\Models\staff;

use Illuminate\Database\Eloquent\Model;

class AppointmentDetailsAudit extends Model{
    protected $table="zest_staff_appointment_audit";
    public $timestamps = false;
    protected $fillable = [
        'ID',
        'ApointmentDate',
        'Year',
        'CID',
        'ContractEndDate',
        'EmpID' ,
        'EmployeeType',
        'FirstName',
        'MiddleName' ,
        'LastName',
        'MajorGroupID' ,
        'MasterGroup',
        'Position',
        'PositionID',
        'PositionLevelID',
        'RCSCSelected',
        'FullWorkingAgency',
        'SubGroup',
        'SubGroupID',
        'SuperStructure',
        'SuperStructureID',
        'WorkAgencyTopNode',
        'WorkAgencyTopNodeID',
        'positionLevel',
        'subLevel',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
    ];
}
