<?php

namespace App\Models\staff;
use App\Models\staff_masters\SeperationMaster;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class ZestSubstitution extends Model{
    use HasFactory;
    protected $table="zest_substitution_details";
    public $timestamps = false;
    protected $fillable = [
        'EID','CID','Name','Position_Title','Position_Level','Sub_Level','Working_Address','Appointment_Date','For_EID'
    ];
}
