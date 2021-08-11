<?php

namespace App\Models\Masters;
namespace App\Models\Masters;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class SubjectMarks extends Model
{
    //
    use HasFactory, Uuid;
    protected $table="subject_marks";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'streamId',
        'aca_sub_id',
        'marks',
        'grade',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];
}