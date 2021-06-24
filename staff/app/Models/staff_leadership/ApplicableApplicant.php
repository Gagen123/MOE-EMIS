<?php
namespace App\Models\staff_leadership;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
class ApplicableApplicant extends Model
{
    use HasFactory, Uuid;
    protected $table="staff_applicable_applicant";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'leadership_id',
        'role_id',
    ];
}
