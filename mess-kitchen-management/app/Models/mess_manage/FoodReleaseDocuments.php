<?php

namespace App\Models\mess_manage;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuid;

class FoodReleaseDocuments extends Model
{
    //
    use HasFactory, Uuid;
    protected $table="food_release_documents";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'foodreleaseId',
        'attachment_for',
        'path',
        'original_name',
        'user_defined_name',
    ];

}
