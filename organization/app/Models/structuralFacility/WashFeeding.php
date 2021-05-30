<?php

namespace App\Models\structuralFacility;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WashFeeding extends Model{
    use HasFactory, Uuid;
    protected $table="wash_feeding";
    protected $fillable = [
        'id','orgId','questionId','answer','type','ans_type','created_by','updated_by'
    ];
}
