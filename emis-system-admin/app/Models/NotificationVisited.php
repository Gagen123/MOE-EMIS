<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class NotificationVisited extends Model{
    use HasFactory, Uuid;
    protected $table="notification_visited";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'notification_id',
        'user_id',
    ];
}
