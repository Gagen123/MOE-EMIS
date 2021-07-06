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
        StockReceivedItem::create($stockreciveitems);
         // dd($stockreciveitems);
      }
      return $this->successResponse($stockrcv, Response::HTTP_CREATED);
    }

    public function loadFoodReleaseListing($org_Id=""){
     // dd($org_Id);
      $stckrecive = DB::table('stock_receiveds')
      ->select('id','organizationId','dateOfreceived as dateOfreceived', 'quarter_id as quarter', 'remarks as remarks')->where('organizationId', $org_Id)->get();
      return $stckrecive;
      // $response_data=StockReceived::where('organizationId',$org_Id)->get();
      // return $this->successResponse($response_data);
    }
    public function viewitemreceived($item=""){
    // dd('from micro');
     $list = DB::table('stock_received_items as a')
     ->join('stock_receiveds as b', 'a.stockreceivedId', '=','b.id')
     ->select('b.dateOfreceived as dateOfreceived','b.quarter_id as quarter',
     'a.item_id as item','a.receivedquantity as quantity','a.unit_id as unit',
     'a.remarks as remarks')->where('a.stockreceivedId',$item)->get();
     return $list;
     //dd($list);
     //  dd('from services');
    }
 }
