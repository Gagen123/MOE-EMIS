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
{    use ApiResponser;

    public function __construct()
    {
        date_default_timezone_set('Asia/Dhaka');
    }


    public function loadFoodReleaseListing($org_id=""){
     //  return 'from service of mine';
       $stckrecive = DB::table('stock_receiveds')
       ->select('dateOfreceived as dateOfreceived', 'term_id as term')->where('organizationId', $org_id)->get();
       return $stckrecive;
        // $response_data=StockReceived::where('organizationId',$org_id)->get();
        // return $this->successResponse($response_data);
    }


    public function getfoodreleaseditemList($foodreleaseId){
        $foodreleaseitem = DB::table('item_released_notes')
        ->select('item_id', 'quantity', 'unit_id')->where('foodreleaseId', $foodreleaseId)->get();
        return $foodreleaseitem;
        
    }
    public function saveStockReceived(Request $request){
        dd('m here');
      $stockreceive = [
        'organizationId'           =>  $request['organizationId'],
        'dateOfreceived'           =>  $request['dateOfreceived'],
        'term_id'                  =>  $request['term'],
        'updated_by'               =>  $request->user_id,
        'created_at'               =>  date('Y-m-d h:i:s')
      ];
      $stckrcv = StockReceived::create($stockreceive);
      
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
         //  dd('stockreceive');
        }
         //  dd('m here');
        return $this->successResponse($stckiss, Response::HTTP_CREATED);
    }



}
