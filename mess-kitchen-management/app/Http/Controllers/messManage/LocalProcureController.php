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
       // dd($request);
        $orgId = $request['organizationId'];
        $date = $request['dateOfprocure'];
        foreach ($request->local_item as $i=> $item){
            // if($i==1){
            //     dd($item);
            // }
            
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
         //    dd( $localprocure);
            $localpro = LocalProcure::create($localprocure);
            $checkitem=TransactionTable::where('item_id',$itm_id)->where('procured_type','Local')
            ->where('organizationId',$orgId)->first();
            if($checkitem!=null && $checkitem!=""){
                $qty=$quantity+$checkitem->available_qty;
                $update_data=[
                    'available_qty' =>  $qty,
                    'updated_by'    =>  $request->user_id,
                    'updated_at'    =>  date('Y-m-d h:i:s'),
                ];

                TransactionTable::where('item_id',$itm_id)->where('procured_type','Local')
                ->where('organizationId',$orgId)->update($update_data);
            }
            else{
                $create_data=[
                    'procured_type'        =>  'Local',
                    'organizationId'       =>  $orgId,
                    'item_id'              =>  $itm_id,
                    'available_qty'        =>  $quantity,
                    'created_by'           =>  $request->user_id,
                    'created_at'           =>  date('Y-m-d h:i:s'),
                ];
             //    dd( $create_data);
                TransactionTable::create($create_data);
            }
        }
        //  dd('m here');
        //   dd('localprocure');
        return $this->successResponse($localpro, Response::HTTP_CREATED);
    }

    public function loadLocalProcure($orgId=""){
        //   return 'from service of mine';
        $list = DB::table('local_procures')
        ->select('id as id','organizationId', 'dateOfprocure as dateOfprocure', 'item_id as item','quantity as quantity', 'unit_id as unit', 'amount as amount')->where('organizationId', $orgId)->get();
        return $list;
    }

    public function localProcureEditList($locId=""){
       //  dd($locId);
        $response_data=LocalProcure::where('id', $locId)->first();
        return $this->successResponse($response_data);
    
       
    }
    public function saveLocalProcureEdit(Request $request){
       // dd($request);
        $current_stock_data=LocalProcure::where('id', $request->id)->where('organizationId',$request->organizationId)->first();
       // dd($current_stock_data);
        if($current_stock_data!=null && $current_stock_data!=""){
            $current_stock_qty=   $current_stock_data->quantity;
            $request_qty=  $request->quantity;
            if($request_qty > $current_stock_qty){
                $qty_diff = $request_qty-$current_stock_qty;
                $qty_to_update_stock=  $current_stock_qty+ $qty_diff;
                $stock_data=[
                //    'organizationId'     => $request->organizationId,
                    'quantity'           => $qty_to_update_stock,
                   // 'damagequantity' => $request->damagequantity,
                    'dateOfprocure'      => $request->dateOfprocure,
                    'food_source'        => $request->source,
                    // 'item_id'            => $request->item_id, 
                    // 'unit_id'            => $request->unit_id,
                    'amount'             => $request->amount,
                    'remark'             => $request->remark,
                   // 'user_id'            =>  $this->userId()
                ];
              // dd($stock_data);
                $update_Issue= LocalProcure::where('item_id', $request->item_id)->update($stock_data);
                $curr_tr_data=TransactionTable::where('organizationId',$current_stock_data->organizationId)
                ->where('item_id', $current_stock_data->item_id)->where('procured_type','Local')->first();
                $stock_qty= $curr_tr_data->available_qty;
                $update_tr_qty=  $stock_qty+ $qty_diff;
                $tr_data=[
                    'available_qty'  => $update_tr_qty,
                    'updated_by'     => $request->user_id,
                    'updated_at'     =>  date('Y-m-d h:i:s'),
                ];
             //   dd($tr_data);
                $update_Issue= TransactionTable::where('item_id', $current_stock_data->item_id)->where('procured_type','Local')->update($tr_data);
               
            }else{
                $qty_diff = $current_stock_qty -$request_qty;
                $qty_to_update_stock= $current_stock_qty-$qty_diff;
               // dd( $qty_to_update_stock);
                $stock_data=[
                    'quantity'           => $qty_to_update_stock,
                    'food_source'        => $request->source,
                    'dateOfprocure'      => $request->dateOfprocure,
                    'amount'             => $request->amount,
                    'remark'             => $request->remark
                ];
               // dd($stock_data);
                $update_Issue= LocalProcure::where('item_id', $current_stock_data->item_id)->where('organizationId',$current_stock_data->organizationId)->update($stock_data);
                $curr_tr_data=TransactionTable::where('organizationId',$current_stock_data->organizationId)
                ->where('item_id', $current_stock_data->item_id)->where('procured_type','Local')->first();
                $stock_qty= $curr_tr_data->available_qty;
                $update_tr_qty=  $stock_qty-$qty_diff;
                $tr_data=[
                    'available_qty' => $update_tr_qty,
                    'updated_by'    => $request->user_id,
                    'updated_at'    =>  date('Y-m-d h:i:s'),
                ];
              // dd( $tr_data);
                $update_Issue=TransactionTable::where('item_id', $current_stock_data->item_id)->where('procured_type','Local')->update($tr_data);
            }
            
        }
        return $this->successResponse($update_Issue);
    }
  
}
