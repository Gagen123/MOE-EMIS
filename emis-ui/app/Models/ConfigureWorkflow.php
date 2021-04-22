<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfigureWorkflow extends Model
{
    use HasFactory;
    protected $table="t_workflow_mapping";
    protected $fillable = [
        'process_id',
        'action_id',
        'role_id'
    ];

    //Gewog belongs to a Dzongkhag.
    public function process() {
        return $this->belongsTo(Process::class, 'process_id');
    }
    public function role(){
        return $this->hasmany(Role::class, 'role_id');
    }
    public function action(){
        return $this->hasmany(ActionType::class, 'action_id');
    }
}
