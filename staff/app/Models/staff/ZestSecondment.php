<?php

namespace App\Models\staff;

use App\Models\staff_masters\SecondmentMaster;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class ZestSecondment extends Model{
    use HasFactory;
    protected $table="zest_seperation_details";
    public $timestamps = false;
    protected $fillable = [
        'ID',
        'StaffID',
        'CID',
        'SecondmentTypeID',
        'OrganisationStructureID',
        'ParentAgencyID',
        'CountryID',
        'PositionTitle',
        'StartDate',
        'EndDate',
        'CommisionNo',
        'CommisionDate',
        'MinYrCompletion',
        'NoTrainingObligation',
        'NoDesciplineAction',
        'NominationApproved',
        'ParentNOC',
        'SecurityClearance',
        'AuditClearance',
        'ReceivingAgencyAcceptance',
        'MaxDurationCheck',
        'IsOutsideCS',
    ];
    public function type(){
        return $this->belongsTo(SecondmentMaster::class, 'SecondmentTypeID')->select('id','name as mastertypename');
    }
}
