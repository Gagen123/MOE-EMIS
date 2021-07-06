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
        'shortlisted_remarks',
        'shortlisted_by',
        'shortlisted_at',
        'feedback_remarks',
        'feedback_start_date',
        'feedback_end_date',
        'feedback_details',
        'feedback_updated_date',
        'feedback_updated_by',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
    ];
}
