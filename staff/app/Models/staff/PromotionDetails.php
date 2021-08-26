<?php

namespace App\Models\staff;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PromotionDetails extends Model{
    use HasFactory, Uuid;
    protected $table="staff_promotion_details";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'staffId',
        'promotionTypeId',
        'childGroupPositionID',
        'superStructureID',
        'positionLevelID',
        'organisationStructureID',
        'effectiveDate',
        'active',
        'revokeOrderNo',
        'revokeOrderDate',
        'revokeReason',
        'revokedBy',
        'revokedDate',
        'revokeHRCNo',
        'revokeHRCDate',
        'securityClearanceNo',
        'auditClearanceNo',
        'isSplRequest',
        'byOrderNo',
        'byOrderDate',
        'approvedBy',
        'approvedDate',
        'hRCNo',
        'hRCDate',
        'commissionNo',
        'commissionDate',
        'subLevel',
        'isPromotion',
        'isQualify',
        'parentAgencyID',
        'relievingOrderNo',
        'relievingOrderDate',
        'joiningOrderNo',
        'joiningOrderDate',
        'specialistPositionID',
        'batchNo',
        'areaOfSpecializationID',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
        'status'
    ];
}
