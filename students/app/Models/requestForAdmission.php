<?php

namespace App\Models;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class requestForAdmission extends Model
{
    //
    use HasFactory,Uuid;
    public $timestamps = false;
    protected $table="request_for_admissions";
    protected $fillable = [
        'id',
        'dzongkhag',
        'school',
        'class',
        'stream',
        'dateOfapply',
        'reasons',
        'snationality',
        'created_at',
        'updated_at'

    ];
}
