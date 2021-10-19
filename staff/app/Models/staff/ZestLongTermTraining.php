<?php

namespace App\Models\staff;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class ZestLongTermTraining extends Model{
    use HasFactory;
    protected $table="zest_longterm_training_details";
    public $timestamps = false;
    protected $fillable = [
        'ID',
        'ProposalID',
        'StaffID',
        'EmailID',
        'LevelID',
        'IssueTypeID',
        'Course',
        'StartDate',
        'EndDate',
        'FundingID',
        'StudyModeID',
        'ProposalStatusID',
        'TrainingStatusID',
        'HRCNo',
        'HRCDate',
        'HRCReason',
        'CommisionNo',
        'CommisionDate',
        'PDBDate',
        'PDBTime',
        'PDBLocation',
        'PDBFocalOfficer',
        'PDBCC',
        'PDBRemarks',
        'Rationale',
        'SecClearanceNo',
        'AuClearanceNo',
        'MCNo',
        'Active',
        'SubmittedBy',
        'SubmittedDate',
        'IsTrainingVerified',
        'IsOtherVerified',
        'ProposingAgencyID',
        'ApprovedBy',
        'ApprovedDate',
        'RegretBy',
        'RegretDate',
    ];
}
