<?php

namespace App\Models\Sen;

use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
    protected $table = 'sen_entities';
    public $timestamps = false;

    public $fillable = ['id', 'name'];

}
