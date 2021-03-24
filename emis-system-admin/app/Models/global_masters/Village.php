<?php

namespace App\Models\global_masters;
use App\Models\global_masters\Gewog;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
    use HasFactory, Uuid;
    protected $table="village_master";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'gewog_id',
        'name',
        'code',
        'status',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];

    public function gewog() {
        return $this->belongsTo(Gewog::class, 'gewog_id');
    }
    public function dzothroughgewog(){
        return $this->hasOneThrough(Dzongkhag::class,Gewog::class,'id','id','gewog_id','dzongkhag_id'); 
    }
}
