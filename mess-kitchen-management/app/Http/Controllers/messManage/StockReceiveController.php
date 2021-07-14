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

class StockReceiveController extends Controller
{
    //
    use ApiResponser;

    public function __construct()
    {
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
                  
                    $receiveditem = array(
                        'stockreceivedId'               =>  $request->id,
                        'item_id'                       =>  $facility['item'],
                        'receivedquantity'              =>  $facility['quantity'],
                        'unit_id'                       =>  $facility['unit'],
                        'remarks'                       =>  $facility['remarks'],
                        'updated_by'                    =>  $request->user_id,
                        'created_at'                    =>  date('Y-m-d h:i:s')
                    );
                    $stcrcv = StockReceivedItem::create($receiveditem);
                }
            return $this->successResponse($infra, Response::HTTP_CREATED);

        }else{
            $stockreceive = [
                'dateOfreceived'           =>  $request['dateOfreceived'],
                'quarter_id'               =>  $request['quarter'],
                'organizationId'           =>  $request['organizationId'],
                'remarks'                  =>  $request['remarks'],
                'id'                       =>  $request->id,
                'created_by'               =>  $request->user_id,
                'created_at'               =>  date('Y-m-d h:i:s')
            ];
            // dd(Infrastructure::createOrFail($infrastructure));
            // dd($infrastructure);
            $stcrcv = StockReceived::create($stockreceive);
            $stockreceivedId = $stcrcv->id;
           foreach ($request->input('items_received') as  $i=> $facility){
            // dd( $stockreceivedId);
           // dd($facility);
                $receiveditem = array(
                    'stockreceivedId'              =>  $stockreceivedId,
                    'item_id'                      =>  $facility['item'],
                    'receivedquantity'             =>  $facility['quantity'],
                    'unit_id'                      =>  $facility['unit'],
                    'remarks'                      =>  $facility['remarks'],
                    'created_by'                   =>  $request->user_id,
                    'created_at'                   =>  date('Y-m-d h:i:s')
                );
               //dd($facilityInStructure);
              
               StockReceivedItem::create($receiveditem);
               $checkitem=TransactionTable::where('item_id',$facility['item'])->where('procured_type','Central')->first();
                if($checkitem!=null && $checkitem!=""){
                    $qty=$facility['quantity']+$checkitem->available_qty;

                    $update_data=[
                        'available_qty' => $qty,
                        'updated_by'    =>$request->user_id,
                        'updated_at'    =>  date('Y-m-d h:i:s'),
                    ];
                    TransactionTable::where('item_id',$facility['item'])->where('procured_type','Central')->update($update_data);  
                }
                else{
                    $create_data=[
                        'procured_type'  =>'Central',
                        'organizationId' =>$request['organizationId'],
                        'item_id'        =>$facility['item'],
                        'available_qty'  =>$facility['quantity'],
                        'created_by'     =>$request->user_id,
                        'created_at'     =>  date('Y-m-d h:i:s'),
                    ];
                 //   dd($create_data);
                    TransactionTable::create($create_data); 
                    
                }

            }
            return $this->successResponse($stcrcv, Response::HTTP_CREATED);
        }
    }
    public function loadFoodReleaseListing($orgId=""){
       //  dd($orgId);
        $stckrecive = DB::table('stock_receiveds')
        ->select('id','organizationId','dateOfreceived as dateOfreceived', 'quarter_id as quarter', 'remarks as remarks')->where('organizationId', $orgId)->get();
        return $stckrecive;
        // $response_data=StockReceived::where('organizationId',$org_Id)->get();
        // return $this->successResponse($response_data);
    }

    public function viewitemreceived($stockreceivedId=""){
      //  dd($stockreceivedId);
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
