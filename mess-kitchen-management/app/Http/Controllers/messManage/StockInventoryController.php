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
use App\Models\mess_manage\TransactionTable;

use Exception;

use Illuminate\Support\Facades\DB;

class StockInventoryController extends Controller
{

    use ApiResponser;

    public function __construct()
    {
        date_default_timezone_set('Asia/Dhaka');
    }
    // public function getInventoryList($orgId){
   
    //     $response_data = DB::select("SELECT aa.item_id, aa.organizationId, aa.unit_id, aa.stock_received_quantity, b.stock_issed_quantity, aa.local_procured_quantity, b.Damage_Qty
    //     FROM
    //         (SELECT  c.item_id, c.organizationId, c.unit_id, SUM(c.stock_received_quantity) AS stock_received_quantity ,
    //         SUM(c.local_procured_quantity) AS local_procured_quantity
    //         FROM
    //         (SELECT a.item_id, f.organizationId, a.unit_id, a.receivedquantity AS stock_received_quantity , 0 AS local_procured_quantity
    //          FROM stock_received_items a
    //          LEFT JOIN stock_receiveds f ON a.stockreceivedId = f.id
    //          UNION
    //          SELECT item_id,organizationId, unit_id, 0 AS stock_received_quantity, quantity AS local_procured_quantity
    //          FROM local_procures) c
    //         GROUP BY c.item_id, c.organizationId, c.unit_id) aa
    //         LEFT JOIN
    //         (SELECT item_id,organizationId, unit_id, SUM(quantity) AS stock_issed_quantity, SUM(damagequantity) AS Damage_Qty
    //       FROM stock_issueds  GROUP BY organizationId, item_id, unit_id) b ON aa.item_id=b.item_id
    //       WHERE aa.organizationId='".$orgId."'");
    //      return $this->successResponse($response_data);
    // //    }catch(Exception $e){
    // //     dd($e);
    //    }

    public function getInventoryList($orgId){
     
             $response_data = DB::select(" SELECT aa.item_id, aa.organizationId, aa.unit_id, aa.stock_received_quantity, b.stock_issed_quantity, b.Damage_Qty, d.Available_Qty, d.procured_type
             FROM
             (SELECT  c.item_id, c.organizationId, c.unit_id, SUM(c.stock_received_quantity) AS stock_received_quantity
             
             FROM
             (SELECT a.item_id, f.organizationId, a.unit_id, a.receivedquantity AS stock_received_quantity 
              FROM stock_received_items a
              LEFT JOIN stock_receiveds f ON a.stockreceivedId = f.id
             ) c
             GROUP BY c.item_id, c.organizationId, c.unit_id) aa
             LEFT JOIN
             (SELECT item_id,organizationId, unit_id, SUM(quantity) AS stock_issed_quantity, SUM(damagequantity) AS Damage_Qty
           FROM stock_issueds  GROUP BY organizationId, item_id, unit_id) b ON aa.item_id=b.item_id
           LEFT JOIN 
           (SELECT organizationId, item_id, procured_type, SUM(available_qty) AS Available_Qty FROM mess_transaction_table
           WHERE procured_type = 'Central'
           GROUP BY organizationId, item_id) d ON aa.item_id = d.item_id
           WHERE   aa.organizationId='".$orgId."'");
          return $this->successResponse($response_data);
     //    }catch(Exception $e){
     //     dd($e);
     //    }
 
    }
    public function getInventoryListLocal($orgId){
     
        $response_data = DB::select(" SELECT aa.item_id, aa.organizationId, aa.unit_id, aa.Lcoal_quantity, b.stock_issed_quantity, b.Damage_Qty, d.Available_Qty, d.procured_type
        FROM
       
        (SELECT item_id, organizationId, unit_id, SUM(quantity) AS Lcoal_quantity 
         FROM `local_procures` 
        GROUP BY item_id, organizationId, unit_id) aa
        LEFT JOIN
        (SELECT item_id,organizationId, unit_id, SUM(quantity) AS stock_issed_quantity, SUM(damagequantity) AS Damage_Qty
      FROM stock_issueds  GROUP BY organizationId, item_id, unit_id) b ON aa.item_id=b.item_id
      LEFT JOIN 
      (SELECT organizationId, item_id,procured_type, SUM(available_qty) AS Available_Qty FROM `mess_transaction_table` 
      WHERE`procured_type` = 'Local'
      GROUP BY organizationId, item_id) d ON aa.item_id = d.item_id
      WHERE   aa.organizationId='".$orgId."'");
     return $this->successResponse($response_data);
//    }catch(Exception $e){
//     dd($e);
//    }

}

 













    // public function getInventoryListLocal($orgId){
      
    //          $response_data = DB::select("SELECT aa.item_id, aa.organizationId, aa.unit_id, aa.local_procured_quantity, b.stock_issed_quantity, b.Damage_Qty, d.Available_Qty
    //          FROM
            
    //          (SELECT item_id, organizationId, unit_id, SUM(quantity) AS local_procured_quantity 
    //           FROM `local_procures` 
    //          GROUP BY item_id, organizationId, unit_id) aa
    //          LEFT JOIN
    //          (SELECT item_id,organizationId, unit_id, SUM(quantity) AS stock_issed_quantity, SUM(damagequantity) AS Damage_Qty
    //        FROM stock_issueds  GROUP BY organizationId, item_id, unit_id) b ON aa.item_id=b.item_id
    //        LEFT JOIN 
    //        (SELECT organizationId, item_id, SUM(available_qty) AS Available_Qty FROM mess_transaction_table
    //        WHERE procured_type="Local") d ON aa.item_id = d.item_id

    //        WHERE aa.organizationId='".$orgId."'");
    //       return $this->successResponse($response_data);
    
 
     
}
