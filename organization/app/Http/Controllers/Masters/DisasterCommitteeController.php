<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use App\Models\Masters\DisasterCommittee;
use Illuminate\Support\Facades\DB;

class DisasterCommitteeController extends Controller
{
    //
    use ApiResponser;
    public $audit_database;

    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
      //  $this->audit_database = config('services.constant.auditdb');
    }


    public function saveDisasterCommittee(Request $request){
         //  dd('here at services ');
           //return($request['disasterName']);
          
        $dis = [
            'name'          => $request['disasterCommName'],
            'description'   => $request['description'],
            'status'        => $request['status'],
            'created_by'    => $request['user_id'],
            'updated_by'    => $request['user_id'],
            'created_at'    =>date('Y-m-d h:i:s'),
            'updated_at'    =>date('Y-m-d h:i:s'),
        ];
        $disastercomm = DisasterCommittee::create($dis);

        return $this->successResponse($disastercomm, Response::HTTP_CREATED);
           
    }
    public function loadDisasterComm(){
       // dd('services');
        $loadcomm = DisasterCommittee::all();
        return $loadcomm;
    }
}
