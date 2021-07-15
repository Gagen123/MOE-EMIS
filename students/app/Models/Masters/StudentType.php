<?php

namespace App\Models\Masters;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentType extends Model
{
    use HasFactory, Uuid;
    protected $table="std_student_type";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'Name',
        'Status',
        'Description',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];
}
