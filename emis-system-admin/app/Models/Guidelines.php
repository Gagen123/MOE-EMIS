<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuid;
class Guidelines extends Model
{
    use HasFactory, Uuid;
    protected $table="master_guidelines";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'guideline_for',
        'guideline',
        'status',
        'display_order',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];
}
