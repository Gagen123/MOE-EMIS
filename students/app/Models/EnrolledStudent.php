<?php

namespace App\Models;
use App\Traits\Uuid;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class EnrolledStudent extends Model
{
      //
      use HasFactory,Uuid;
      public $timestamps = false;
      protected $table="enrolled_students";
      protected $fillable = [
          'id',
          'std_id',
          'org_id',
          'dzo_id',
          'class_id',
          'dateOfapply',
          'remarks',
          'created_at',
          'updated_by',
          'updated_at'
      ];
}
