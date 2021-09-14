<?php

namespace App\Models\Masters;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class DocumentType extends Model{
    use HasFactory, Uuid;
    protected $table="master_document_type";
    protected $fillable = [
        'id','name','code','applicableTo', 'description', 'status','created_by','updated_by'
    ];
}
