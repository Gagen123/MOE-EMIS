<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrganizationClassStreamHistory extends Model{
    use HasFactory;
    protected $table="organization_class_streams_history";
    protected $fillable = [
        'record_id',
        'id',
        'organizationId',
        'classId',
        'streamId',
        'created_by',
        'updated_by',
        'recorded_on',
        'recorded_for',
        'recorded_by'
    ];
    
}
