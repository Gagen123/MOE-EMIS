<?php

namespace App\Models\masters;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuid;


class TeachingSubject extends Model
{
    //
    use HasFactory, Uuid;
    protected $table="aca_teaching_subject";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'name',
        'code',
        'displayorder',
        'description',
        'status', 
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
    ];
}


