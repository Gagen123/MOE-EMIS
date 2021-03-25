<?php

namespace App\Models\establishment;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EstablishmentClassStream extends Model
{
    use HasFactory, Uuid;
    protected $table="establishment_class_streams";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','establishmentId','classId','streamId','created_by','updated_by'
    ];
}
