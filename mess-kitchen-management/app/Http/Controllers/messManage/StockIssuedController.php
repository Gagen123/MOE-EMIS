<?php

namespace App\Http\Controllers\messManage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use App\Models\mess_manage\StockIssued;
use Illuminate\Support\Facades\DB;
use Exception;

class StockIssuedController extends Controller
{
    use ApiResponser;

    public function __construct()
    {
        date_default_timezone_set('Asia/Dhaka');
    }
    public function saveStockIssued(Request $request){
        // foreach($request->item_issue as $item){
        //     $item['dateOfissue'] = $request['dateOfissue'];
        //     $item["organizationId"] = $request['organizationId'];
        //     // $item["item"] = $request['item_id'];
        //     // $item["quantity"] = $request['quantity'];
        //     // $item["unit"] = $request['unit_id'];
        //     // $item["damagequantity"] = $request['damagequantity'];
        //     // $item["remarks"] = $request['remarks'];
        //     $item["created_by"] = $request["user_id"];
        //     $item["created_at"] = date('Y-m-d h:i:s');

        // //     $stockissue = array(
        // //      'organizationId'            =>  $orgId,
        // //      'dateOfissue'               =>  $request['dateOfissue'];
             
        // //      'item'                      =>  $item['item'],
        // //      'quantity'                  =>  $item['quantity'],
        // //      'unit'                      =>  $item['unit'],
        // //      'damagequantity'            =>  $item['damagequantity'],
        // //      'remarks'                   =>  $item['remarks'],
        // //      'updated_by'                =>  $request->user_id,
        // //      'created_at'                =>  date('Y-m-d h:i:s')


        // //     );
        // dd($item);
        //  $stckiss = StockIssued::create($item);
        //   // dd('stockissue');
        // }
        //  //  dd('m here'); 
              //  dd('m here');
        $orgId = $request['organizationId'];
        $date = $request['dateOfissue'];
     foreach ($request->item_issue as $i=> $item){
            $itemIssued = array(
             'organizationId'             =>  $orgId,
             'dateOfissue'                =>  $date,
             'item_id'                    =>  $item['item'],
             'quantity'                   =>  $item['quantity'],
             'unit_id'                    =>  $item['unit'],
             'damagequantity'             =>  $item['damagequantity'],
             'remarks'                    =>  $item['remarks'],
             'updated_by'                 =>  $request->user_id,
             'created_at'                 =>  date('Y-m-d h:i:s')
            );

         $itemiss = StockIssued::create($itemIssued);
        }
      //  dd('m here');
     //    dd('localprocure'); 
        return $this->successResponse($itemiss, Response::HTTP_CREATED);  
       // return $this->successResponse($item, Response::HTTP_CREATED);
    }
    public function loadStockIssuedList($org_Id=""){
    //  return 'from service of mine';
        try{
            $list = DB::table('stock_issueds')
            ->select('organizationId', 'dateOfissue as dateOfissue','item_id as item', 'quantity as quantity','unit_id as unit')->where('organizationId',$org_Id)->get();
            return $list;
        }catch(Exception $e){
            dd($e);

        }
    }
    // public function getStockIssueItem($org_Id=''){
    //     $list = DB::table('stock_issueds')
    //     ->select( 'dateOfissue as dateOfissue','item_id as item','quantity as quantity','unit as unit','damagequantity as damageqty','remarks as remarks')->where('organizationId',$org_Id)->get();
    //     return $list;
    //   }
=======
         //  dd('m here');
        return $this->successResponse($item, Response::HTTP_CREATED);
    }
    public function loadStockIssuedList(){
     //return 'from service of mine';
        $list = DB::table('stock_issueds')
        ->select( 'dateOfissue as dateOfissue',)->get();
        return $list;
    }
>>>>>>> 9149ce33cb5c495b39ab8f76700b00bd7cc5b238
}
