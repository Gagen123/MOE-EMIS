<?php

namespace App\Models;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdmissionAttachments extends Model
{
    //
    use HasFactory,Uuid;
    public $timestamps = false;
    protected $table="admission_request_files";
    protected $fillable = [
        'id',
        'AdmissionRequestId',
        'fileName',
        'filePath',
        'snationality',
        'created_at',
        'updated_at'

    ];
}
