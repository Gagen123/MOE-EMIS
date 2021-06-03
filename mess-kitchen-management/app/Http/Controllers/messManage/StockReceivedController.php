<?php

namespace App\Http\Controllers\messManage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use App\Models\mess_manage\StockReceived;
use App\Models\mess_manage\StockReceivedItem; 
use Illuminate\Support\Facades\DB;

class StockReceivedController extends Controller
{
    //
    use ApiResponser;

    public function __construct()
    {
        date_default_timezone_set('Asia/Dhaka');
    }
    public function saveStockReceived(Request $request){
      //  dd('m here at my service');
       $stockreceived = [
           'dateOfreceived'             =>  $request['dateOfreceived'],
           'quarter_id'                 =>  $request['quarter'],
           'remarks'                    =>  $request['remarks'],
           'organizationId'             =>  $request['organizationId'],
           'updated_by'                 =>  $request->user_id,
           'created_at'                 =>  date('Y-m-d h:i:s')
       ];
     // dd($stockreceived);
       $stockrcv = StockReceived::create($stockreceived); 

       foreach ($request->items_received as $i => $item){
           $stockreciveitems = array(
               'stockreceivedId'              =>  $stockrcv->id,
               'item_id'                      =>  $item['item'],
               'receivedquantity'             =>  $item['quantity'],
               'unit_id'                      =>  $item['unit'],
               'remarks'                      =>  $item['remarks'],
               'updated_by'                   =>  $request->user_id,
               'created_at'                   =>  date('Y-m-d h:i:s')
           );
         //  dd($stockrcv);
           StockReceivedItem::create($stockreciveitems);
       }
       return $this->successResponse($stockrcv, Response::HTTP_CREATED);
    }

    public function loadFoodReleaseListing($org_Id=""){
      //  dd('m here');
     // return 'from service of mine';
       $stckrecive = DB::table('stock_receiveds')
      ->select('id','organizationId', 'dateOfreceived as dateOfreceived', 'quarter_id as quarter', 'remarks as remarks')->where('organizationId', $org_Id)->get();
      return $stckrecive;
    }

 //just added 
    public function getStockReceivedDetails($stockreceivedId=""){
        $response_data=StockReceived::where('id',$stockreceivedId)->first();
        $response_data->stockreceived=StockReceivedItem::where('stockreceivedId',$response_data->id)->get();
        return $this->successResponse($response_data); 
    }
    
    
    // public function getfoodreleaseditemList($stockreceivedId){
    //     $foodreleaseitem = DB::table('item_released_notes')
    //     ->select('item_id', 'quantity', 'unit_id')->where('stockreceivedId', $stockreceivedId)->get();
    //     return $foodreleaseitem;
    // }

}
