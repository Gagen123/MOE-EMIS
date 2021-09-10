<?php

namespace App\Models\staff;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
class SubstitutionModel extends Model{
    use HasFactory, Uuid;
    protected $table="staff_substitution";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'cid',
        'name',
        'gender',
        'dzongkhag',
        'dob',
        'contact',
        'email',
        'qualification',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
    ];
}
