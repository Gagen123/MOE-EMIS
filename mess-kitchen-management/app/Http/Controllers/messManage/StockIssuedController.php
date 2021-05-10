<?php

namespace App\Http\Controllers\messManage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use App\Models\mess_manage\StockIssued;
use Illuminate\Support\Facades\DB;

class StockIssuedController extends Controller
{
    use ApiResponser;

    public function __construct()
    {
        date_default_timezone_set('Asia/Dhaka');
    }
    public function saveStockIssued(Request $request){
        // dd('m here');
        $date = $request['dateOfissue'];
        foreach  ($request->item_issue as $i=> $item){
            $stockissue = array(
             'dateOfissue'               =>  $date,
             'item'                      =>  $item['item'],
             'quantity'                  =>  $item['quantity'],
             'unit'                      =>  $item['unit'],
             'damagequantity'            =>  $item['damagequantity'],
             'remarks'                   =>  $item['remarks'],
             'updated_by'                =>  $request->user_id,
             'created_at'                =>  date('Y-m-d h:i:s')
            );
         $stckiss = StockIssued::create($stockissue);
         dd('mhere');
        }
      //  dd('m here');
        return $this->successResponse($stckiss, Response::HTTP_CREATED);
    }
    public function loadStockIssuedList(){
     //return 'from service of mine';
        $list = DB::table('stock_issueds')
        ->select( 'dateOfissue as Date',)->get();
        return $list;
    }
}
