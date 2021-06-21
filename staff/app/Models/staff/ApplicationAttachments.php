<?php

namespace App\Models\staff;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ApplicationAttachments extends Model
{
    use HasFactory, Uuid;
    protected $table="application_attachments";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'ApplicationDetailsId',
        'name',
        'user_defined_file_name',
        'upload_type',
        'path',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];
}
