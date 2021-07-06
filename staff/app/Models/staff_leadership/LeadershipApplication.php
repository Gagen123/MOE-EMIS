<?php
namespace App\Models\staff_leadership;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
class LeadershipApplication extends Model
{
    use HasFactory, Uuid;
    protected $table="staff_leadership_application";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'application_number',
        'leadership_id',
        'staff_id',
        'dzongkhag_id',
        'org_id',
        'accessLevel',
        'status',
        'remarks',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
    ];
}
