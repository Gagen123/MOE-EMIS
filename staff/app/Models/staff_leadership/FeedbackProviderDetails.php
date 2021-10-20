<?php

namespace App\Models\staff_leadership;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
class FeedbackProviderDetails extends Model{
    use HasFactory, Uuid;
    protected $table="staff_leadership_nominee_feedback_detials";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'application_number',
        'partifipant_from',
        'participant',
        'positiontitle',
        'cid',
        'eid',
        'name',
        'email',
        'contact',
        'department',
        'school',
        'dzongkhag',
        'feedback_type',
        'status',
        'created_by',
        'created_at',
        'updated_at',
        'updated_by',
    ];
    // public function leadershipDetails(){
    //     return $this->belongsTo(LeadershipDetails::class, 'leadership_id');
    // }
    // public function nomineeDetails(){
    //     return $this->belongsTo(NominationDetails::class, 'nominees_id');
    // }
}
