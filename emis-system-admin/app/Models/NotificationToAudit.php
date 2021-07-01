<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class NotificationToAudit extends Model
{
    use HasFactory, Uuid;
    protected $table="notification_to_audit";
    public $timestamps = false;
    protected $fillable = [
        'audit_id',
        'id',
        'notification_id',
        'user_role_id',
        'access_level',
        'dzo_id',
        'audited_at',
        'audited_by',
    ];
}
