<?php

namespace App\Models;
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrganizationSectionHistory extends Model
{
    use HasFactory;
    protected $table="section_details_history";
    protected $fillable = [
        'record_id',
        'id',
        'classSectionId',
        'section',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
        'recorded_on',
        'recorded_for',
        'recorded_by'
    ];
}
