<?php

namespace App\Models\staff;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model{
    use HasFactory, Uuid;
    protected $table="staff_program_participant";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'program_id',
        'org_id',
        'dzo_id',
        'contact',
        'email',
        'nature_of_participant',
        'attachment_details',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
        'status'
    ];
}
