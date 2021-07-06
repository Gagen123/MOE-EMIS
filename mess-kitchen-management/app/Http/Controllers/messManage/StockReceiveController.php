<?php

namespace App\Http\Controllers\messManage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use App\Models\mess_manage\StockReceived;
use App\Models\mess_manage\StockReceivedItem; 
use Illuminate\Support\Facades\DB;

class StockReceiveController extends Controller
{
    //
    use ApiResponser;

    public function __construct()
    {
        date_default_timezone_set('Asia/Dhaka');
    }

    public function getStockReceivedDetails($stockreceivedId=""){
        dd('m here');
        $response_data=StockReceived::where('id',$stockreceivedId)->first();
        $response_data->stockreceived=StockReceivedItem::where('stockreceivedId',$response_data->id)->get();
        return $this->successResponse($response_data); 
    }

}
