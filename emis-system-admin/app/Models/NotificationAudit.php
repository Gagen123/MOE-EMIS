<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuid;
class NotificationAudit extends Model{
    use HasFactory, Uuid;
    protected $table="notification_details_audit";
    public $timestamps = false;
    protected $fillable = [
        'audit_id',
        'id',
        'notification_for',
        'notification_appNo',
        'notification_message',
        'notification_type',
        'notification_access_type',
        'access_level',
        'call_back_link',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
        'audited_at',
        'audited_by',
    ];
}
