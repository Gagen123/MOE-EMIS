<?php

namespace App\Http\Controllers\Masters;

use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ClassStreamController extends Controller
{
    use ApiResponser;

    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
    }
    public function getClassStream(){
        $data = DB::select('SELECT t1.classId AS org_class_id, t1.streamId AS org_stream_id, t2.class, t3.stream FROM class_streams AS t1 JOIN classes AS t2 ON t1.classId=t2.id LEFT JOIN streams AS t3 ON t1.streamId = t3.id and t3.status=1 WHERE t2.status = 1 ORDER BY t2.class');
        return $this->successResponse($data, Response::HTTP_CREATED);
    }
}
