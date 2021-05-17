<?php

namespace App\Models\masters;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuid;

class SubjectCategory extends Model
{
    use HasFactory, Uuid;
    protected $table="aca_subject_category";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'name',
        'display_order',
        'status', 
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
    ];
}
