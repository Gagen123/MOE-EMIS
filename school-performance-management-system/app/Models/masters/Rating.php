<?php

namespace App\Models\masters;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory, Uuid;
    protected $table="spm_rating";
    protected $fillable = [
        'id',
        'score',
        'description',
        'spm_indicator_id',
        'status',
        'created_by'
    ];
}
