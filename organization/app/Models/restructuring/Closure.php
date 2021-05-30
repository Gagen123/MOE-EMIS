<?php

namespace App\Models\restructuring;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Closure extends Model
{
    use HasFactory, Uuid;
    protected $table="closures";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','code','name','category','level','dzongkhag','gewog','chiwog',
        'location','geoPoliticallyLocated','senSchool','reason','remark','created_by','updated_by'
    ];
}
