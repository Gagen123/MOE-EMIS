<?php

namespace App\Models;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class AdmissionValidationModel extends Model
{
    use HasFactory, Uuid;
    public $timestamps = false;
    protected $table="master_age_validation";
    protected $fillable = [
        'id','date','date1','no_months','no_months1','status','created_by','updated_by','created_at','updated_at'
    ];
}
