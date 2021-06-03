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
        //dd('m here');
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

      // $releasId = DB::table('food_releases')->orderBy('id','desc')->limit(1)->pluck('id');
       // dd($request->items_release);
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
       }
       return $this->successResponse($stockrcv, Response::HTTP_CREATED);
      // dd($stockrcv);
    }

    public function loadFoodReleaseListing($org_Id=""){
    //  return 'from service of mine';
       $stckrecive = DB::table('stock_receiveds')
      ->select('dateOfreceived as dateOfreceived', 'term_id as term', 'remarks as remarks')->where('organizationId', $org_Id)->get();
      return $stckrecive;
      // $response_data=StockReceived::where('organizationId',$org_id)->get();
      // return $this->successResponse($response_data);
    }

//just added 
    public function getStockReceivedDetails($stockreceivedId=""){
        $response_data=StockReceived::where('id',$stockreceivedId)->first();
        $response_data->stockreceived=StockReceivedItem::where('stockreceivedId',$response_data->id)->get();
        return $this->successResponse($response_data); 
    }

}
