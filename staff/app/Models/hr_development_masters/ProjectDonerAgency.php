<?php

namespace App\Models\hr_development_masters;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuid;
class ProjectDonerAgency extends Model
{
    use HasFactory, Uuid;
    protected $table="master_stf_project_doner_agency";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'doner_agency_id',
        'name',
        'description',
        'code',
        'description',
        'status',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];
    public function donor(){
        return $this->belongsTo(donor::class, 'doner_agency_id')->select('id','name');
    }
}
