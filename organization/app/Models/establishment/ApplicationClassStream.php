<?php

namespace App\Models\establishment;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ApplicationClassStream extends Model
{
    use HasFactory, Uuid;
    protected $table="application_class_streams";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','applicationNo','classId','streamId','created_by','updated_by'
    ];
}
