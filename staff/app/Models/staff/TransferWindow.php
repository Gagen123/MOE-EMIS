<?php
namespace App\Models\staff;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
class TransferWindow extends Model{
    use HasFactory, Uuid;
    protected $table="stf_transfer_window";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'year',
        'from_date',
        'to_date',
        'remarks',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
        'status'
    ];
}