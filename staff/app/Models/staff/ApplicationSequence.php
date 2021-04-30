<?php

namespace App\Models\staff;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ApplicationSequence extends Model
{
    use HasFactory, Uuid;
    public $timestamps = false;
    protected $table="application_sequence";
    protected $fillable = [
        'id','service_name','last_sequence'
    ];
}
