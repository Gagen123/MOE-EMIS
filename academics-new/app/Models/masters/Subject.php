<?php

namespace App\Models\masters;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuid;

class Subject extends Model
{
    use HasFactory, Uuid;
    protected $table="aca_subject";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'aca_sub_id',
        'name',
        'dzo_name',
        'aca_sub_category_id',
        'display_order',
        'assessed_by_class_teacher',
        'is_special_educational_needs',
        'status',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',

    ];
}
