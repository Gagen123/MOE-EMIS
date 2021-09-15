<?php

namespace App\Models\Masters;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationConfig extends Model
{
    use HasFactory, Uuid;
    protected $table="master_notification_config";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','service_id','submitter_role_id', 'notification_to_role_id','created_by','updated_by'
    ];
}
