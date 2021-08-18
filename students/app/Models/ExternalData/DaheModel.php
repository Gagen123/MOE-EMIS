<?php

namespace App\Models\ExternalData;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DaheModel extends Model{
    use HasFactory, Uuid;
     protected $table="import_abroadstudent_details";
     protected $fillable = [
         'id',
         'AbstudentMale',
         'AbstudentFemale',
         'AbstudentTotal',
         'year',
         'created_at',
         'created_by',
         'updated_by',
         'updated_at'
     ];
}
