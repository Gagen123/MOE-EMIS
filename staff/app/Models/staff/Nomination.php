<?php

namespace App\Models\staff;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class Nomination extends Model{
    use HasFactory, Uuid;
    protected $table="stf_nomination";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'personal_id',
        'nomi_cid',
        'nomi_name',
        'nomi_desig',
        'nomi_address',
        'nomi_contact',
        'nomi_email',
        'nomi_relation',
        'nomi_percentage',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
        'status'
    ];
}
