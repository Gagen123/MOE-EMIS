<?php

namespace App\Models\mess_manage;

use Illuminate\Database\Eloquent\Model;

class ItemReleasedNote extends Model
{
    use HasFactory, Uuid;
    protected $table="item_released_notes";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','foodreleaseId','item','quantity','unit',
        'remark','created_by','updated_by'
    ];
}
