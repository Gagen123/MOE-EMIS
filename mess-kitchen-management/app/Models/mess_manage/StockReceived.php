<<<<<<< HEAD
<?php

namespace App\Models\mess_manage;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StockReceived extends Model
{
    use HasFactory, Uuid;
    protected $table="stock_receiveds";

    protected $fillable = [
        'id',
        'organizationId',
        'dateOfreceived',
        'quarter_id',
        'remarks',
        'created_by',
        'updated_by'
    ];
}
=======
<?php

namespace App\Models\mess_manage;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StockReceived extends Model
{
    use HasFactory, Uuid;
    protected $table="stock_receiveds";

    protected $fillable = [
        'id',
        'organizationId',
        'dateOfreceived',
        'term_id',
        'remarks',
        'created_by',
        'updated_by'
    ];
}
>>>>>>> 19c11771b5c9e7268c1cd32088b5e69342ffa6ab
