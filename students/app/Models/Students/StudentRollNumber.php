<?php
namespace App\Models\Students;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentRollNumber extends Model
{
    use HasFactory, Uuid;
    public $timestamps = false;
    protected $table="student_rollnumbers";
    protected $fillable = [
        'id','std_id','std_class','Name','student_code','std_stream','std_section','roll_no','organization_id','user_id'
    ];
}
