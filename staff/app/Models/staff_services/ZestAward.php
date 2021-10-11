<?php

namespace App\Models\staff_services;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
class ZestAward extends Model{
    use HasFactory, Uuid;
    protected $table="zest_award_details";
    public $timestamps = false;
    protected $fillable = [
        'ID',
        'StaffID',
        'AwardTypeID',
        'Year',
        'AwardDate',
        'PassportWpNo',
        'CID',
        'FirstName',
        'MiddleName',
        'LastName',
        'NameDz',
        'Position',
        'PositionDz',
        'PositionLevel',
        'CountryID',
        'CandidateTypeID',
        'NonCSAgencyID',
        'DateOfAppointment',
        'YearsServed',
        'Remarks',
        'Contact',
        'Active',
        'SubmittedBy',
        'SubmittedDate',
        'ApprovedBy',
        'ApprovedDate',
        'RejectedBy',
        'RejectedDate',
        'RejectReason',
        'SubmittedByAgencyID',
    ];
}
