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
       //  dd('m here');
        $orgId = $request['organizationId'];
        $date = $request['dateOfprocure'];
     foreach ($request->local_item as $i=> $item){
            $localprocure = array(
             'organizationId'             =>  $orgId,
             'dateOfprocure'              =>  $date,
             'item_id'                    =>  $item['item'],
             'quantity'                   =>  $item['quantity'],
             'unit_id'                    =>  $item['unit'],
             'amount'                     =>  $item['amount'],
             'remark'                     =>  $item['remark'],
             'updated_by'                 =>  $request->user_id,
             'created_at'                 =>  date('Y-m-d h:i:s')
            );

         $localpro = LocalProcure::create($localprocure);
        }
      //  dd('m here');
     //    dd('localprocure'); 
        return $this->successResponse($localpro, Response::HTTP_CREATED);  
    }
    public function loadLocalProcure($org_Id=""){
        //   return 'from service of mine';
        $list = DB::table('local_procures')
        ->select('organizationId', 'dateOfprocure as dateOfprocure', 'item_id as item','quantity as quantity', 'unit_id as unit', 'amount as amount')->where('organizationId', $org_Id)->get();
        return $list;
    }
}
