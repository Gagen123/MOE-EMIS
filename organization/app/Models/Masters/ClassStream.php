<?php

namespace App\Models\Masters;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClassStream extends Model
{
    use HasFactory, Uuid;
    protected $table="class_stream_mappings";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'classId', 
        'streamId', 
        'status'
    ];
}
