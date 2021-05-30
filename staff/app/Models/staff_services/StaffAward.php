<?php

namespace App\Models\staff_services;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
class StaffAward extends Model{
    use HasFactory, Uuid;
    protected $table="staff_awards";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'staff_id',
        'award_given_by',
        'award_type_id',
        'date',
        'place',
        'remarks',
        'coursetitle',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
    ];
}
