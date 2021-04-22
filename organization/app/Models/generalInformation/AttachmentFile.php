<?php

namespace App\Models\generalInformation;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AttachmentFile extends Model
{
    use HasFactory, Uuid;
    protected $table="attachment_files";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','orgRecordId','filePath','title','remark'
    ];
}
