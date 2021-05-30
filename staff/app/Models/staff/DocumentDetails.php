<?php

namespace App\Models\staff;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
class DocumentDetails extends Model{
    use HasFactory, Uuid;
    protected $table="staff_documents";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'parent_id',
        'attachment_for',
        'path',
        'original_name',
        'user_defined_name',
    ];
}
