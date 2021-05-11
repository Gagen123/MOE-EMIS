<?php

namespace App\Http\Controllers\messManage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use App\Models\mess_manage\LocalProcure; 
use Illuminate\Support\Facades\DB;

class LocalProcureController extends Controller
{
    use ApiResponser;

    public function __construct()
    {
        date_default_timezone_set('Asia/Dhaka');
    }

    public function saveLocalProcure(Request $request){
         dd('m here');
        $date = $request['dateOfprocure'];
     foreach ($request->local_item as $i=> $item){
            $localprocure = array(
             'dateOfprocure'              =>  $date,
             'item'                       =>  $item['item'],
             'quantity'                   =>  $item['quantity'],
             'unit'                       =>  $item['unit'],
             'amount'                     =>  $item['amount'],
             'remark'                     =>  $item['remark'],
             'updated_by'                 =>  $request->user_id,
             'created_at'                 =>  date('Y-m-d h:i:s')
            );

         $localpro = LocalProcure::create($localprocure);
        }
        // dd('m here'); 
        return $this->successResponse($localpro, Response::HTTP_CREATED);  
    }
    public function loadLocalProcure(){
          // return 'from service of mine';
        $list = DB::table('local_procures')
        ->select( 'dateOfprocure as Date')->get();
        return $list;
    }
}
