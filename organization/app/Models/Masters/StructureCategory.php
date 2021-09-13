<?php

namespace App\Models\Masters;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StructureCategory extends Model
{
    use HasFactory, Uuid;
    protected $table="structure_category";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','name','code','description', 'status','created_by','updated_by','created_at','updated_at'
    ];
}
