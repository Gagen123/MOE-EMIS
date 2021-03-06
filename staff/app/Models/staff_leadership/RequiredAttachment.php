<?php
namespace App\Models\staff_leadership;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
class RequiredAttachment extends Model
{
    use HasFactory, Uuid;
    protected $table="staff_leadership_document_requirements";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'leadership_id',
        'attachment',
    ];
}
