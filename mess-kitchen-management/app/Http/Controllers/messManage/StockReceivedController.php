<?php

namespace App\Http\Controllers\messManage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use App\Models\mess_manage\StockReceived; 
use Illuminate\Support\Facades\DB;

class StockReceivedController extends Controller
{    use ApiResponser;

    public function __construct()
    {
        date_default_timezone_set('Asia/Dhaka');
    }
//     public function saveStockReceived(Request $request){
//      //   dd('m here');
//        $date = $request['dateOfreceived'];
      
//      foreach ($request->local_item as $i=> $item){
//            $stockreceived = array(
//              'dateOfprocure'              =>  $date,
//             // 'quarter'                    =>  $termId,
//              'item'                       =>  $item['item'],
//              'receivedquantity'           =>  $item['quantity'],
//              "'pending'+index'"           =>  $item["'pending'+index'"],
//              'unit'                       =>  $item['unit'],
//              'remarks'                    =>  $item['remarks'],
//              'updated_by'                 =>  $request->user_id,
//              'created_at'                 =>  date('Y-m-d h:i:s')
//              );
//          $stkrec = StockReceived::create($stockreceived);
//        }
//         dd('m here'); 
//        return $this->successResponse($stkrec, Response::HTTP_CREATED);  
//    }
//    public function loadStockReceivedList(){
//          // return 'from service of mine';
//        $list = DB::table('local_procures')
//        ->select( 'dateOfprocure as dateOfprocure')->get();
//        return $list;
//    }

    public function getFoodRelease($termId = ""){
       // return 'from service of mine';
      $list = DB::table('stock_receiveds')
      ->select( 'dateOfreceived','quarter')->get();
      return $list;
    }
}
