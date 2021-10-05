<?php

namespace App\Models\staff_masters;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
class StaffAwardType extends Model
{
    use HasFactory, Uuid;
    protected $table="master_staff_award_type";
    public $timestamps = false;
    protected $fillable = [
        'id',
        // 'parent_id',
        'name',
        'description',
        'code',
        'status',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];

    // public function category() {
    //     return $this->belongsTo(StaffAwardCategory::class, 'parent_id');
    // }

}
