<?php

namespace App\Models\generalInformation;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SectionDetails extends Model
{
    use HasFactory, Uuid;
    protected $table="section_details";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','classSectionId', 'section','created_by','updated_by'
    ];

    public function class_stream() {
        return $this->belongsTo(OrganizationClassStream::class, 'sectionId');
    }
}
