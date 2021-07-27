<?php

namespace App\Http\Controllers\messManage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use App\Models\mess_manage\StockIssued;
use App\Models\mess_manage\LocalProcure;
use App\Models\mess_manage\TransactionTable;
use Illuminate\Support\Facades\DB;
use Exception;

class StockIssuedController extends Controller
{
    use ApiResponser;

    public function __construct()
    {
        date_default_timezone_set('Asia/Dhaka');
    }
    // public function saveStockIssued(Request $request){
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
    //     $orgId = $request['organizationId'];
    //     $date = $request['dateOfissue'];
    //  foreach ($request->item_issue as $i=> $item){
    //         $itemIssued = array(
    //          'organizationId'             =>  $orgId,
    //          'dateOfissue'                =>  $date,
    //          'item_id'                    =>  $item['item'],
    //          'quantity'                   =>  $item['quantity'],
    //          'unit_id'                    =>  $item['unit'],
    //          'damagequantity'             =>  $item['damagequantity'],
    //          'remarks'                    =>  $item['remarks'],
    //          'updated_by'                 =>  $request->user_id,
    //          'created_at'                 =>  date('Y-m-d h:i:s')
    //         );

    //      $itemiss = StockIssued::create($itemIssued);
    //     }
    //   //  dd('m here');
    //  //    dd('localprocure');
    //     return $this->successResponse($itemiss, Response::HTTP_CREATED);
    //    // return $this->successResponse($item, Response::HTTP_CREATED);
    // }

    public function saveStockIssued(Request $request){
     // dd($request);
        $id = $request->id;
        $orgId = $request['organizationId'];
        $date = $request['dateOfissue'];

        if($id != null){
            DB::table('stock_issueds')->where('id', $request->id)->delete();
            foreach ($request->itemList as $i=> $item){
                $rem="NA";
                if(isset($item['remarks'])){
                    $rem=$item['remarks'];
                }
                $quantity=0;
                if(isset($item['available_qty'])){
                    $quantity=$item['available_qty'];
                }
                $damagequantity=0;
                if(isset($item['damagequantity'])){
                    $damagequantity=$item['damagequantity'];
                }
                $itemIssued = array(
                    'organizationId'              =>  $orgId,
                    'dateOfissue'                 =>  $date,
                    'id'                         =>  $id,
                    'item_id'                    =>  $item['id'],
                    'quantity'                   =>  $quantity,
                    'unit_id'                    =>  $item['Unit_id'],
                    'damagequantity'             =>  $damagequantity,
                    'remarks'                    =>  $rem,
                    'updated_by'                 =>  $request->user_id,
                    'created_at'                 =>  date('Y-m-d h:i:s')
                );
                $itemiss = StockIssued::create($itemIssued);
            }
            return $this->successResponse($itemiss,Response::HTTP_CREATED);
        }else {
        //  dd($request);
            $orgId = $request['organizationId'];
            $date = $request['dateOfissue'];
            foreach ($request->itemList as $i=> $item){
                $rem="NA";
                if(isset($item['remarks'])){
                    $rem=$item['remarks'];
                }
                $quantity=0;
                if(isset($item['issue_qty'])){
                    $quantity=$item['issue_qty'];
                }
                $damagequantity=0;
                if(isset($item['damagequantity'])){
                    $damagequantity=$item['damagequantity'];
                }
                $itemIssued = array(
                    'organizationId'             =>  $orgId,
                    'dateOfissue'                =>  $date,
                    'item_id'                    =>  $item['id'],
                    'quantity'                   =>  $quantity,
                    'unit_id'                    =>  $item['Unit_id'],
                    'damagequantity'             =>  $damagequantity,
                    'remarks'                    =>  $rem,
                    'category'                   =>  $request['category'],
                    'created_by'                 =>  $request->user_id,
                    'created_at'                 =>  date('Y-m-d h:i:s')
                );

                $itemiss = StockIssued::create($itemIssued);
                $checkitem=TransactionTable::where('item_id',$item['id'])->where('organizationId',$orgId)->first();
                $qty=$checkitem->available_qty-($quantity);//$damagequantity,taken out as its contributing negative values in transaction
                $update_data=[
                    'available_qty' => $qty,
                    'updated_by'    => $request->user_id,
                    'updated_at'    =>  date('Y-m-d h:i:s'),
                ];
                TransactionTable::where('item_id',$item['id'])->update($update_data);
            }
            return $this->successResponse($itemiss, Response::HTTP_CREATED);
      }
    }
    public function loadStockIssuedList($orgId=""){
            $list = DB::table('stock_issueds')
            ->select('id','organizationId', 'dateOfissue as dateOfissue','item_id as item','category', 'quantity as quantity','unit_id as unit')->where('organizationId',$orgId)->get();
            return $list;
    }

    public function getAvailableStocks($id="",$type=""){
        $response_data=TransactionTable::where('item_id',$id)->where('procured_type',$type)->first();
        return $response_data;
    }
    public function StockIssueEditList($lssId=""){
        //dd($lssId);
        $response_data=StockIssued::where('id', $lssId)->first();
        $response_data->availaleqty=TransactionTable::where('item_id',$response_data->item_id)->where('procured_type',$response_data->category)->first()->available_qty;
        return $this->successResponse($response_data);
    }
    public function getquantity($itemId="", $chekva="", $orgId=""){

    //  dd( $orgId,$itemId,$chekva  );
      $response_data=TransactionTable::where('item_id', $itemId)
      ->where('procured_type',$chekva)
      ->where('organizationId',$orgId )->first();
    //  dd($response_data);
      return $this->successResponse($response_data);
    }

}
