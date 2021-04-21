<?php

namespace App\Models\global_masters;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gewog extends Model{
    use HasFactory;
    protected $table="gewog_master";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'dzongkhag_id',
        'name',
        'code',
        'status',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];
    
    public function dzongkhag() {
        return $this->belongsTo(Dzongkhag::class, 'dzongkhag_id');
    }
}
