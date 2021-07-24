<?php

namespace App\Models\masters;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromotionRule extends Model
{
    use HasFactory, Uuid;
    protected $table="aca_promotion_rule";
    protected $fillable = [
        'id',
        'org_class_id',
        'org_stream_id', 
        'aca_sub_id',
        'aca_promotion_sub_group_id',
        'created_at',
        'created_by',
        'updated_by',
        'updated_at',
    ];
}
