<?php

namespace App\Models\Students;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class std_seat extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table="std_seat";
    protected $fillable = [
        'id',
        'org_id',
        'std_seat',
        'status',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];

}
