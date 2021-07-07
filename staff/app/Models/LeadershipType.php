<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuid;
class LeadershipType extends Model{
    use HasFactory, Uuid;
    protected $table="master_staff_leadership_type";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'name',
        'isfeedbackapplicable',
        'status',
        'type',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];
}
