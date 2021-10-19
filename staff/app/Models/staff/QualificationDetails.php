<?php
namespace App\Models\staff;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class QualificationDetails extends Model{
    use HasFactory, Uuid;
    protected $table="stf_qualification";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'category',
        'doner_id',
        'project_doner_id',
        'field_id',
        'degree_id',
        'type',
        'personal_id',
        'description',
        'qualification',
        'coursemode',
        'coursetitle',
        'first_subject',
        'second_subject',
        'country',
        'institute_id',
        'startdate',
        'remarks',
        'enddate',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
        'status',
        'qua_status',
    ];
}
