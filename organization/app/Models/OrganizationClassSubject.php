<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuid;
class OrganizationClassSubject extends Model{
    use HasFactory,Uuid;
    public $timestamps = false;
    protected $table="organization_class_subject";
    protected $fillable = [
        'id',
        'organizationId',
        'classId',
        'streamId',
        'sectionId',
        'subjectId',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
    ];
}
