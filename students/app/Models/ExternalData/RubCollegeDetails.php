<?php

namespace App\Models\ExternalData;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RubCollegeDetails extends Model
{
    //
    use HasFactory, Uuid;
    protected $table="import_institutes_details";

    protected $fillable = [
        'id',
        'collegeName',
        'dzongkhag',
        'own_by',
        'status',
        'remarks',
        'institutes_type',
        'org_id',
        'created_at',
        'created_by',
        'updated_by',
        'updated_at'
    ];
}
