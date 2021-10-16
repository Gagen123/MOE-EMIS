<?php

namespace App\Models\staff_masters;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class TrainingStatus extends Model{
    use HasFactory;
    protected $table="master_training_status";
    public $timestamps = false;
    protected $fillable = [
        'ID',
        'Status',
        'TrainingType',
        'EntryBy',
        'EntryDate',
    ];
}
