<?php

namespace App\Models\establishment;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ApplicationClassStream extends Model
{
    use HasFactory, Uuid;
    protected $table="application_class_stream";
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'foreignKeyFor',
        'ApplicationDetailsId',
        'classId',
        'streamId'
    ];
    public function withClass(){
        return $this->belongsTo(Classes::class, 'classId')->select('id','class');
    }
}
