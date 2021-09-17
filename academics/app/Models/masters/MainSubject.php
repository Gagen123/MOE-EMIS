<?php

namespace App\Models\masters;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainSubject extends Model
{
    use HasFactory, Uuid;
    protected $table="aca_main_subject";
    protected $fillable = [
        'id',
        'name',
        'code',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
    ];
}
