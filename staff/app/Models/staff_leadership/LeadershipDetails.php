<?php
namespace App\Models\staff_leadership;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
class LeadershipDetails extends Model{
    use HasFactory, Uuid;
    protected $table="staff_leadership_detials";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'selection_type',
        'position_title',
        'feedback',
        'interview',
        'shortlist',
        'from_date',
        'to_date',
        'question_category',
        'details',
        'status',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
    ];
}
