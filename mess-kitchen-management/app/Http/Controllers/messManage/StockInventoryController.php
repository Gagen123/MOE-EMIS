<?php

namespace App\Http\Controllers\messManage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use App\Models\mess_manage\StockReceived;
use App\Models\mess_manage\StockReceivedItem; 
use App\Models\mess_manage\LocalProcure; 
use App\Models\mess_manage\StockIssued;
use Exception;

use Illuminate\Support\Facades\DB;

class StockInventoryController extends Controller
{

    use ApiResponser;

    public function __construct()
    {
        date_default_timezone_set('Asia/Dhaka');
    }
    public function getInventoryList($orgId){
       // dd($orgId);
        //  return 'from service of mine';
        //    $stckrecive = DB::table('stock_receiveds')
        //   ->select('dateOfreceived as dateOfreceived', 'term_id as term', 'remarks as remarks')->where('organizationId', $org_Id)->get();
        //   return $stckrecive;
        //   // $response_data=StockReceived::where('organizationId',$org_id)->get();
        //   // return $this->successResponse($response_data);
     //  try{  
            $response_data = DB::select("SELECT a.item_id, a.organizationId, a.unit_id, a.stock_received_quantity, b.stock_issed_quantity, c.local_procured_quantity
          FROM
          (SELECT a.item_id, f.organizationId, a.unit_id, SUM(a.receivedquantity) AS stock_received_quantity FROM 
           stock_received_items a
           LEFT JOIN stock_receiveds f ON a.stockreceivedId = f.id GROUP BY f.organizationId, a.item_id, a.unit_id) a
          LEFT JOIN
          (SELECT item_id,organizationId, unit_id, SUM(quantity) AS stock_issed_quantity FROM stock_issueds GROUP BY organizationId, item_id, unit_id) b ON a.item_id=b.item_id
          LEFT JOIN
          (SELECT item_id,organizationId, unit_id, SUM(quantity) AS local_procured_quantity FROM local_procures GROUP BY organizationId, item_id, unit_id) c ON a.item_id=c.item_id
         WHERE a.organizationId = ? GROUP BY a.stock_received_quantity,  b.stock_issed_quantity, c.local_procured_quantity, a.organizationId, a.unit_id, a.item_id",[$orgId]);
         return $this->successResponse($response_data);
    //    }catch(Exception $e){
    //     dd($e);
    //    }
          
    }
}
