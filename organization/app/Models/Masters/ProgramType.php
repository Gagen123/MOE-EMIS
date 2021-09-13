<?php

namespace App\Models\Masters;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProgramType extends Model
{
    //
    use HasFactory, Uuid;
    protected $table="master_program_type";
    protected $fillable = [
        'id','name','code', 'description', 'status','created_by','updated_by','created_at','updated_at'
    ];
}
