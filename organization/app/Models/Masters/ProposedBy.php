<?php

namespace App\Models\Masters;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProposedBy extends Model
{
    use HasFactory, Uuid;
    protected $table="master_proposed_by";
    protected $fillable = [
        'id','name', 'description', 'status','created_by','updated_by'
    ];
}
