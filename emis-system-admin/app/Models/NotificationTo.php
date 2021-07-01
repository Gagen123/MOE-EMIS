<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class NotificationTo extends Model{
    use HasFactory, Uuid;
    protected $table="notification_to";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'notification_id',
        'user_role_id',
        'access_level',
        'dzo_id',
        'working_agency_id',
    ];
}
