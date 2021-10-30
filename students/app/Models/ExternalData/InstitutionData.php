<?php

namespace App\Models\ExternalData;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class InstitutionData extends Model{
    use HasFactory;
    public $timestamps = false;
    protected $table="external_data_institution";
    protected $fillable = [
         'id',
         'name',
         'dzongkhag',
         'institution_type',
         'own_by',
         'remarks',
         'file_path',
         'created_at',
         'created_by',
    ];
}
