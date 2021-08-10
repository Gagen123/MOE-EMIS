<?php

namespace App\Models\generalInformation;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuid;

class ThramPegDocuments extends Model
{
    //
    use HasFactory, Uuid;
    protected $table="thram_peg_documents";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'attachmentId',
        'path',
        'attachment_for',
        'user_defined_name',
        'original_name',
    ]; 
}




