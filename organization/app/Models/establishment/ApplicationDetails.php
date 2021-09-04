<?php

namespace App\Models\establishment;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ApplicationDetails extends Model
{
    use HasFactory, Uuid;
    protected $table="application_details";
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'application_no',
        'establishment_type',
        'category',
        'dzongkhagId',
        'gewogId',
        'chiwogId',
        'application_type',
        'year',
        'status',
        'remarks',
        'applicant_remarks',
        'document_update_remarks',
        'final_assessment_update_remarks',
        'feasibility_study_date',
        'final_assessment_date',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
    ];
}
