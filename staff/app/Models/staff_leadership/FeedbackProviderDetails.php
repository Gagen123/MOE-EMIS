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
        'leadership_id',
        'staff_id',
        'staff_type',
        'cid',
        'name',
        'email',
        'feedback_id',
        'nominees_id',
        'created_by',
    ];
    public function leadershipDetails(){
        return $this->belongsTo(LeadershipDetails::class, 'leadership_id');
    }
    public function nomineeDetails(){
        return $this->belongsTo(NominationDetails::class, 'nominees_id');
    }
}
