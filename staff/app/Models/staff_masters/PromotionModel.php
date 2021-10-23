<?php

namespace App\Models\staff_masters;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class PromotionModel extends Model
{
    use HasFactory;
    protected $table="master_promotion";
    public $timestamps = false;
    protected $fillable = [
        'ID',
        'PromotionType',
    ];
}
