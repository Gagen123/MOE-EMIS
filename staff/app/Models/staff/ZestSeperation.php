<?php

namespace App\Models\staff;

use App\Models\staff_masters\SeperationMaster;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class ZestSeperation extends Model{
    use HasFactory;
    protected $table="zest_seperation_details";
    public $timestamps = false;
    protected $fillable = [
        'ID',
        'StaffID',
        'RefNo',
        'Type',
        'SeparationTypeID',
        'EffectiveDate',
        'OfficeOrderNo',
        'OfficeOrderDate',
        'HasDisciplinaryCase',
        'HasHandlingProperly',
        'HasNoObjection',
        'Active',
    ];
    public function type(){
        return $this->belongsTo(SeperationMaster::class, 'SeparationTypeID')->select('id','name as mastertypename');
    }
}
