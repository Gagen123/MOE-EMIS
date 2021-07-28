<?php

namespace App\Http\Controllers\messManage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use App\Models\mess_manage\LocalProcure;
use App\Models\mess_manage\TransactionTable;
use Illuminate\Support\Facades\DB;

class LocalProcureController extends Controller
{
    use ApiResponser;

    public function __construct()
    {
        date_default_timezone_set('Asia/Dhaka');
    }

    public function saveLocalProcure(Request $request){
      $id = $request->id;
      if($id != null){
      //  DB::table('local_procures')->where('id', $request->id)->update();
        foreach ($request->local_item as $i=> $item){
            // $itm_id=explode('_',$item['item'])[0];
            // $unitid=explode('_',$item['item'])[1];
            
            $remarks='NA';
            if(isset($item['remark'])){
                $remarks= $item['remark'];
            }
            $quantity=0;
            if(isset($item['quantity'])){
                $quantity= $item['quantity'];
            }
            $amount=0;
            if(isset($item['amount'])){
                $amount= $item['amount'];
            }
            $source = $item['source'];
            $localprocure = array(
             'organizationId'             =>  $request->organizationId,
             'dateOfprocure'              =>  $request->dateOfprocure,
             'id'                         =>  $request->id,
             'item_id'                    =>  $item['item'],
             'quantity'                   =>  $quantity,
             'unit_id'                    =>  $item['unit'],
             'amount'                     =>  $amount,
             'food_source'                =>  $source,
             'remark'                     =>  $remarks,
             'updated_by'                 =>  $request->user_id,
             'created_at'                 =>  date('Y-m-d h:i:s')
            );
         //   dd($localprocure);
            LocalProcure::where('id'.$id)->update($localprocure);
            $localpro = LocalProcure::where('id',$id)->first();
        }
         return $this->successResponse($localpro,Response::HTTP_CREATED);
        }else {
      //  dd($request);
        $orgId = $request['organizationId'];
        $date = $request['dateOfprocure'];
        foreach ($request->local_item as $i=> $item){
            $itm_id=explode('_',$item['item'])[0];
            $unitid=explode('_',$item['item'])[1];
            $remarks='NA';
            if(isset($item['remark'])){
                $remarks= $item['remark'];
            }
            $quantity=0;
            if(isset($item['quantity'])){
                $quantity= $item['quantity'];
            }
            $amount=0;
            if(isset($item['amount'])){
                $amount= $item['amount'];
            }
            $source = $item['source'];
            $localprocure = array(
             'organizationId'             =>  $orgId,
             'dateOfprocure'              =>  $date,
             'item_id'                    =>  $itm_id,
             'quantity'                   =>  $quantity,
             'unit_id'                    =>  $unitid,
             'amount'                     =>  $amount,
             'food_source'                =>  $source,
             'remark'                     =>  $remarks,
             'updated_by'                 =>  $request->user_id,
             'created_at'                 =>  date('Y-m-d h:i:s')
            );
           // dd( $localprocure);
         $localpro = LocalProcure::create($localprocure);
         $checkitem=TransactionTable::where('item_id',$itm_id)->where('procured_type','Local')->first();
         if($checkitem!=null && $checkitem!=""){
                $qty=$item['item']+$checkitem->available_qty;

                $update_data=[
                    'available_qty' =>  $qty,
                    'updated_by'    =>  $request->user_id,
                    'updated_at'    =>  date('Y-m-d h:i:s'),
                 ];
                TransactionTable::where('item_id',$itm_id)->where('procured_type','Local')
                ->where('organizationId',$request->organizationId)->update($update_data);
            }
            else{
             $create_data=[
                    'procured_type'        =>  'Local',
                    'organizationId'       =>  $request->organizationId,
                    'item_id'              =>  $itm_id,
                    'available_qty'        =>  $item['quantity'],
                    'created_by'           =>  $request->user_id,
                    'created_at'           =>  date('Y-m-d h:i:s'),
                ];
               // dd( $create_data);
              TransactionTable::create($create_data);
            }
        }
      //  dd('m here');
      //   dd('localprocure');
        return $this->successResponse($localpro, Response::HTTP_CREATED);
    }
}
    public function loadLocalProcure($orgId=""){
        //   return 'from service of mine';
        $list = DB::table('local_procures')
        ->select('id as id','organizationId', 'dateOfprocure as dateOfprocure', 'item_id as item','quantity as quantity', 'unit_id as unit', 'amount as amount')->where('organizationId', $orgId)->get();
        return $list;
    }

    public function localProcureEditList($locId=""){
       //  dd($locId);
        $response_data=LocalProcure::where('id', $locId)->get();
        return $this->successResponse($response_data);
       
    }
}
