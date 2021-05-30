<<<<<<< HEAD
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
        foreach($request->item_issue as $item){
            $item['dateOfissue'] = $request['dateOfissue'];
            $item["organizationId"] = $request['organizationId'];
            $item["created_by"] = $request["user_id"];
            $item["created_at"] = date('Y-m-d h:i:s');

        //     $stockissue = array(
        //      'organizationId'            =>  $orgId,
        //      'dateOfissue'               =>  $request['dateOfissue'];
             
        //      'item'                      =>  $item['item'],
        //      'quantity'                  =>  $item['quantity'],
        //      'unit'                      =>  $item['unit'],
        //      'damagequantity'            =>  $item['damagequantity'],
        //      'remarks'                   =>  $item['remarks'],
        //      'updated_by'                =>  $request->user_id,
        //      'created_at'                =>  date('Y-m-d h:i:s')


        //     );
       // dd($item);
         $stckiss = StockIssued::create($item);
          // dd('stockissue');
        }
         //  dd('m here'); 
        return $this->successResponse($item, Response::HTTP_CREATED);
    }
    public function loadStockIssuedList(){
     //return 'from service of mine';
        $list = DB::table('stock_issueds')
        ->select( 'dateOfissue as dateOfissue','item_id as item', 'quantity as quantity')->get();
        return $list;
    }
    public function getStockIssueItem($org_Id=''){
        $list = DB::table('stock_issueds')
        ->select( 'dateOfissue as dateOfissue','item_id as item','quantity as quantity','unit as unit','damagequantity as damageqty','remarks as remarks')->where('organizationId',$org_Id)->get();
        return $list;
      }
}
=======
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
        foreach($request->item_issue as $item){
            $item['dateOfissue'] = $request['dateOfissue'];
            $item["organizationId"] = $request['organizationId'];
            $item["created_by"] = $request["user_id"];
            $item["created_at"] = date('Y-m-d h:i:s');

        //     $stockissue = array(
        //      'organizationId'            =>  $orgId,
        //      'dateOfissue'               =>  $request['dateOfissue'];
             
        //      'item'                      =>  $item['item'],
        //      'quantity'                  =>  $item['quantity'],
        //      'unit'                      =>  $item['unit'],
        //      'damagequantity'            =>  $item['damagequantity'],
        //      'remarks'                   =>  $item['remarks'],
        //      'updated_by'                =>  $request->user_id,
        //      'created_at'                =>  date('Y-m-d h:i:s')


        //     );
       // dd($item);
         $stckiss = StockIssued::create($item);
          // dd('stockissue');
        }
         //  dd('m here');
        return $this->successResponse($item, Response::HTTP_CREATED);
    }
    public function loadStockIssuedList(){
     //return 'from service of mine';
        $list = DB::table('stock_issueds')
        ->select( 'dateOfissue as dateOfissue',)->get();
        return $list;
    }
}
>>>>>>> 19c11771b5c9e7268c1cd32088b5e69342ffa6ab
