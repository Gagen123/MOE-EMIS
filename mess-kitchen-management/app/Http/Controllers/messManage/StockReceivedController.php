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
    //   dd('m here at my service');
     $stockreceive = [
       'dateOfreceived'           =>  $request['dateOfreceived'],
       'term_id'                  =>  $request['term'],
       'organizationId'           =>  $request['organizationId'],
       'updated_by'               =>  $request->user_id,
       'created_at'               =>  date('Y-m-d h:i:s')
     ];
     
     $stckrcv = StockReceived::create($stockreceive);
    // dd($stckrcv);
       foreach  ($request->items_received as $i=> $item){
           $stockitemrcv = array(
            'stockreceivedId'           =>  $stckrcv->id,
            'item_id'                   =>  $item['item'],
            'receivedquantity'          =>  $item['receivedquantity'],
            'unit_id'                   =>  $item['unit'],
            'remarks'                   =>  $item['remarks'],
            'updated_by'                =>  $request->user_id,
            'created_at'                =>  date('Y-m-d h:i:s')
           );
           StockReceivedItem::create($stockitemrcv);
        // dd($stockitemrcv);
       }
        //  dd('m here');
       return $this->successResponse($stckrcv, Response::HTTP_CREATED);
      // return($stckrcv);
   }

}
