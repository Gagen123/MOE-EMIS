<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
class Calender extends Model{
    use HasFactory, Uuid;
    protected $table="master_calender";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'year',
        'from_date',
        'to_date',
        'type',
        'remarks',
        'user_type',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
        'status'
    ];
}
