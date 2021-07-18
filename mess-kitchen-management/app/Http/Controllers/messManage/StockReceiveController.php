<?php

namespace App\Http\Controllers\messManage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use App\Models\mess_manage\StockReceived;
use App\Models\mess_manage\StockReceivedItem;
use App\Models\mess_manage\TransactionTable;
use Illuminate\Support\Facades\DB;

class StockReceiveController extends Controller{
    use ApiResponser;
    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
    }
    public function saveStockReceived(Request $request){
        $id = $request->id;
        if($id != null){
            $stockreceive = [
                'dateOfreceived'           =>  $request['dateOfreceived'],
                'quarter_id'               =>  $request['quarter'],
                'organizationId'           =>  $request['organizationId'],
                'remarks'                  =>  $request['remarks'],
                'id'                       =>  $request['id'],
                'updated_by'               =>  $request->user_id,
                'created_at'               =>  date('Y-m-d h:i:s')
            ];
            $stcrcv = StockReceived::where('id', $id)->update($stockreceive);

            DB::table('stock_received_items')->where('stockreceivedId', $request->id)->delete();
            foreach ($request->input('items_received') as  $i=> $facility){
                $itm_id=explode('_',$facility['item'])[0];
                $unitid=explode('_',$facility['item'])[1];
                $remarks="";
                if(isset($facility['remarks'])){
                    $remarks=$facility['remarks'];
                }
                $receiveditem = array(
                    'stockreceivedId'               =>  $request->id,
                    'item_id'                       =>  $itm_id,
                    'receivedquantity'              =>  $facility['quantity'],
                    'unit_id'                       =>  $unitid,
                    'remarks'                       =>  $remarks,
                    'updated_by'                    =>  $request->user_id,
                    'created_at'                    =>  date('Y-m-d h:i:s')
                );
                $stcrcv = StockReceivedItem::create($receiveditem);
            }
            return $this->successResponse($stcrcv, Response::HTTP_CREATED);

        }else{
            $stockreceive = [
                'dateOfreceived'           =>  $request['dateOfreceived'],
                'quarter_id'               =>  $request['quarter'],
                'organizationId'           =>  $request['organizationId'],
                'remarks'                  =>  $request['remarks'],
                'status'                   =>  'Submitted',
                'dzo_id'                   =>  $request['dzoId'],
                'created_by'               =>  $request->user_id,
                'created_at'               =>  date('Y-m-d h:i:s')
            ];
            $stcrcv = StockReceived::create($stockreceive);
            $stockreceivedId = $stcrcv->id;
            foreach ($request->input('items_received') as  $i=> $facility){
                $itm_id=explode('_',$facility['item'])[0];
                $unitid=explode('_',$facility['item'])[1];
                $remarks="";
                if(isset($facility['remarks'])){
                    $remarks=$facility['remarks'];
                }
                $receiveditem = array(
                    'stockreceivedId'              =>  $stockreceivedId,
                    'item_id'                      =>  $itm_id,
                    'receivedquantity'             =>  $facility['quantity'],
                    'unit_id'                      =>  $unitid,
                    'remarks'                      =>  $remarks,
                    'created_by'                   =>  $request->user_id,
                    'created_at'                   =>  date('Y-m-d h:i:s')
                );
               StockReceivedItem::create($receiveditem);
               $checkitem=TransactionTable::where('item_id',$itm_id)->where('procured_type','Central')
               ->where('organizationId',$request['organizationId'])->first();
                if($checkitem!=null && $checkitem!=""){
                    $qty=$facility['quantity']+$checkitem->available_qty;
                    $update_data=[
                        'available_qty' => $qty,
                        'updated_by'    =>$request->user_id,
                        'updated_at'    =>  date('Y-m-d h:i:s'),
                    ];
                    TransactionTable::where('item_id',$itm_id)->where('procured_type','Central')->update($update_data);
                }
                else{
                    $create_data=[
                        'procured_type'  =>'Central',
                        'organizationId' =>$request['organizationId'],
                        'item_id'        =>$itm_id,
                        'available_qty'  =>$facility['quantity'],
                        'created_by'     =>$request->user_id,
                        'created_at'     =>  date('Y-m-d h:i:s'),
                    ];
                    TransactionTable::create($create_data);
                }

            }
            return $this->successResponse($stcrcv, Response::HTTP_CREATED);
        }
    }

    public function stockReceivedListing($orgId=""){
        if(strpos($orgId,'_Creater')!==false){
            $response_data = StockReceived::where('created_by',explode('_',$orgId)[0])->get();
        }
        else{
            $response_data = StockReceived::where('organizationId',explode('_',$orgId)[0])->get();
        }
        return $response_data;
    }
    public function viewitemreceived($stockreceivedId=""){
        $list = DB::table('stock_received_items as a')
        ->join('stock_receiveds as b', 'a.stockreceivedId', '=','b.id')
        ->select('b.dateOfreceived as dateOfreceived','b.quarter_id as quarter',
        'a.item_id as item','a.receivedquantity as quantity','a.unit_id as unit',
        'a.remarks as remarks')->where('a.stockreceivedId',$stockreceivedId)->get();
        return $list;
        //dd($list);
        //  dd('from services');
    }
    public function getStockReceivedDetails($stkId=""){
       // dd($stockreceivedId);
        $response_data=StockReceived::where('id',$stkId)->first();
        $response_data->stockreceived=StockReceivedItem::where('stockreceivedId',$stkId)->get();
        return $this->successResponse($response_data);
    }

    public function loadStockReceiveView($StockReceivedID=""){
        $response_data=StockReceived::where('id',$StockReceivedID)->first();
        if($response_data!="" && $response_data!=null){
            $response_data->facility=StockReceivedItem::where('stockreceivedId',$response_data->id)->get();
        }
        return $this->successResponse($response_data);
    }

    public function loadStockReceivedDetails($id=""){
        $response_data=StockReceived::where('id',$id)->first();
        if($response_data!="" && $response_data!=null){
            $response_data->itemDetails=StockReceivedItem::where('stockreceivedId',$id)->get();
        }
        return $this->successResponse($response_data);
    }

    public function approvereject(Request $request){
        $status='Approved';
        if($request->action_type=="reject"){
            $status='Rejected';
        }
        $basic_details = [
            'approve_reject_remarks'            =>  $request->remarks,
            'status'                            =>  $status,
            'approve_reject_by'                 =>  $request->user_id,
            'approve_reject_at'                 =>  date('Y-m-d h:i:s')
        ];
        StockReceived::where('id',$request->id)->update($basic_details);
        $basic = StockReceived::where('id',$request->id)->first();
        return $this->successResponse($basic, Response::HTTP_CREATED);
    }


    // public function saveStockReceived(Request $request){
    //     //   dd('m here at my service');
    //      $stockreceive = [
    //        'dateOfreceived'           =>  $request['dateOfreceived'],
    //        'quarter_id'               =>  $request['quarter'],
    //        'organizationId'           =>  $request['organizationId'],
    //        'remarks'                  =>  $request['remarks'],
    //        'id'                       =>  $request->id,
    //        'updated_by'               =>  $request->user_id,
    //        'created_at'               =>  date('Y-m-d h:i:s')
    //      ];

    //      $stckrcv = StockReceived::create($stockreceive);
    //     // dd($stckrcv);
    //        $stockreceivedId = $stckrcv->id;
    //        foreach  ($request->items_received as $i=> $item){
    //          //  dd($item);
    //            $stockitemrcv = array(
    //             'stockreceivedId'           =>  $stockreceivedId,
    //             'item_id'                   =>  $item['item'],
    //             'receivedquantity'          =>  $item['receivedquantity'],
    //             'unit_id'                   =>  $item['unit'],
    //             'remarks'                   =>  $item['remarks'],
    //             'updated_by'                =>  $request->user_id,
    //             'created_at'                =>  date('Y-m-d h:i:s')
    //            );
    //            StockReceivedItem::create($stockitemrcv);
    //          //dd($stockitemrcv);
    //          dd( $stockreceivedId);
    //        }
    //         //  dd('m here');
    //        return $this->successResponse($stckrcv, Response::HTTP_CREATED);
    //       // return($stckrcv);
    //    }
}
