<?php

namespace App\Models\Masters;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class CounsellingClassRange extends Model
{
    use HasFactory, Uuid;
    protected $table="std_counselling_class_range";

    protected $fillable = [
        'id',
        'Name', 
        'Description',
        'Code',
        'Status',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'

    ];
}
