<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrgProfile extends Model{
    use HasFactory, Uuid;
    protected $table="organization_profile";
    protected $fillable = [
        'id',
        'org_id',
        'mission',
        'vission',
        'logo_path',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];
}
