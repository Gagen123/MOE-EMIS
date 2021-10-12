<?php

namespace App\Models\staff_masters;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class FundingAgency extends Model{
    use HasFactory;
    protected $table="master_funcing_agencie";
    public $timestamps = false;
    protected $fillable = [
        'ID',
        'Name',
        'FundingGroupID',
        'TrainingType',
        'Active',
        'IsDeleted',
        'EntryBy',
        'EntryDate',
        'UpdatedBy',
        'UpdatedDate',
        'TrainingTypeID',
    ];
}
