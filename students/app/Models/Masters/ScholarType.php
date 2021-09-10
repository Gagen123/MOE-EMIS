<?php

namespace App\Models\Masters;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ScholarType extends Model{
    use HasFactory, Uuid;
    protected $table="std_scholarship";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'Name',
        'SchoolCategory',
        'Description',
        'Code',
        'Status',
        'created_by', 
        'created_at',
        'updated_by',
        'updated_at'
    ];
}
