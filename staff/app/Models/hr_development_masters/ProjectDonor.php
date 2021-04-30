<?php

namespace App\Models\hr_development_masters;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuid;
class ProjectDonor extends Model{
    use HasFactory, Uuid;
    protected $table="master_donor_project";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'donor_id',
        'name',
        'code',
        'status',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];

    public function donor() {
        return $this->belongsTo(Donor::class, 'donor_id');
    }
}
