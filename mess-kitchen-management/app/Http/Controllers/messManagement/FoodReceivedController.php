<?php

namespace App\Http\Controllers\messManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use App\Models\mess_manage\StockReceived; 
use App\Models\mess_manage\StockReceivedItem; 
use Illuminate\Support\Facades\DB;

class FoodReceivedController extends Controller
{
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
     //dd($stckrcv);
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
          $stckrcv =  StockReceivedItem::create($stockitemrcv);
         // dd($stockitemrcv);
        }
         //  dd('m here');
        return $this->successResponse($stckrcv, Response::HTTP_CREATED);
       
       // dd($stckrcv);
    }

    public function loadFoodReleaseListing($org_Id=""){
      //  return 'from service of mine';
         $stckrecive = DB::table('stock_receiveds')
        ->select('id','organizationId','dateOfreceived as dateOfreceived', 'quarter_id as quarter', 'remarks as remarks')->where('organizationId', $org_Id)->get();
        return $stckrecive;
        // $response_data=StockReceived::where('organizationId',$org_id)->get();
        // return $this->successResponse($response_data);
    }
    public function viewitemreceived($stockreceivedId=''){
        $list = DB::table('stock_received_items')
        ->select( 'item_id as item','receivedquantity as quantity','unit_id as unit', 'remarks as remarks')->where('stockreceivedId',$stockreceivedId)->get();
        return $list;
        //dd($list);
      //  dd('from services');
    }
   
    public function getfoodreleaseditemList($foodreleaseId){
        $foodreleaseitem = DB::table('item_released_notes')
        ->select('item_id', 'quantity', 'unit_id')->where('foodreleaseId', $foodreleaseId)->get();
        return $foodreleaseitem;
    }

}
