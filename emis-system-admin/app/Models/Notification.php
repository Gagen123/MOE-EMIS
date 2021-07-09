<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuid;
class Notification extends Model{
    use HasFactory, Uuid;
    protected $table="notification_details";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'notification_for',
        'notification_appNo',
        'notification_message',
        'notification_type',
        'notification_access_type',
        'access_level',
        'call_back_link',
        'action',
        'created_by',
        'created_at',
        'updated_by',
        'udpated_on',
    ];
}
