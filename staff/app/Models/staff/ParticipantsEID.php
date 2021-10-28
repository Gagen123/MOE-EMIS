<?php

namespace App\Models\staff;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class ParticipantsEID extends Model{
    use HasFactory;
    protected $table="participant_table";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'eid',
        'is_match',
        'name',
        'program_id',
        'org_id',
        'dzo_id',
        'participant_id',
        'contact',
        'email',
        'nature_of_participant',
        'created_by',
        'created_at'
    ];
}
