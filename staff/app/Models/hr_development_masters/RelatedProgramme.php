<?php

namespace App\Models\hr_development_masters;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuid;
class RelatedProgramme extends Model{
    use HasFactory, Uuid;
    protected $table="master_related_programme";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'name',
        'code',
        'description',
        'status',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];
}
