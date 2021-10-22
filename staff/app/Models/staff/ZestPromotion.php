<?php

namespace App\Models\staff;

use App\Models\staff_masters\PromotionModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class ZestPromotion extends Model{
    use HasFactory;
    protected $table="zest_promotion_details";
    public $timestamps = false;
    protected $fillable = [
        'ID',
        'StaffID',
        'PromotionTypeID',
        'ChildGroupPositionID',
        'SuperStructureID',
        'PositionLevelID',
        'SubLevel',
        'OrganisationStructureID',
        'EffectiveDate',
        'Active',
        'SecurityClearanceNo',
        'AuditClearanceNo',
        'IsSplRequest',
        'HRCNo',
        'JoiningOrderNo',
        'JoiningOrderDate',
    ];
    public function type(){
        return $this->belongsTo(PromotionModel::class, 'PromotionTypeID')->select('ID','PromotionType as mastertypename');
    }
}
