<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\DietaryBasic;
use App\Models\Dietarydates;
use App\Models\DietaryDetails;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
class DietaryController extends Controller{
    use ApiResponser;
    public function __construct()    {
        date_default_timezone_set('Asia/Dhaka');
    }
    public function savediatery(Request $request){
        // $basic_details = [
        //    'score'                      =>  $request->total_score,
        //    'date'                       =>  $request->record_date,
        //    'remarks'                    =>  $request->remarks,
        //    'organizationId'             =>  $request->org_id,
        // ];
        // if($request->action_type=="add"){
        //     $basic_details = $basic_details+[
        //         'created_by'                 =>  $request->user_id,
        //         'created_at'                 =>  date('Y-m-d h:i:s')
        //     ];
        //     $basic = DietaryBasic::create($basic_details);
        // }
        // else{
        //     $basic_details = $basic_details+[
        //         'updated_by'                 =>  $request->user_id,
        //         'updated_at'                 =>  date('Y-m-d h:i:s')
        //     ];
        //     DietaryBasic::where('id',$request->id)->update($basic_details);
        //     $basic = DietaryBasic::where('id',$request->id)->first();
        // }
        // $dietary_details = array(
        //     'basic_id'                  =>  $basic->id,
        //     'b_cereal'                  =>  $request->b_cereal,
        //     'b_root'                    =>  $request->b_root,
        //     'b_veg'                     =>  $request->b_veg,
        //     'b_meat'                    =>  $request->b_meat,
        //     'b_egg'                     =>  $request->b_egg,
        //     'b_fish'                    =>  $request->b_fish,
        //     'b_pulse'                   =>  $request->b_pulse,
        //     'b_milk'                    =>  $request->b_milk,
        //     'b_fruit'                   =>  $request->b_fruit,
        //     'b_oil'                     =>  $request->b_oil,
        //     'b_sugar'                   =>  $request->b_sugar,
        //     'b_chilli'                  =>  $request->b_chilli,

        //     'l_cereal'                  =>  $request->l_cereal,
        //     'l_root'                    =>  $request->l_root,
        //     'l_veg'                     =>  $request->l_veg,
        //     'l_meat'                    =>  $request->l_meat,
        //     'l_egg'                     =>  $request->l_egg,
        //     'l_fish'                    =>  $request->l_fish,
        //     'l_pulse'                   =>  $request->l_pulse,
        //     'l_milk'                    =>  $request->l_milk,
        //     'l_fruit'                   =>  $request->l_fruit,
        //     'l_oil'                     =>  $request->l_oil,
        //     'l_sugar'                   =>  $request->l_sugar,
        //     'l_chilli'                  =>  $request->l_chilli,

        //     't_cereal'                  =>  $request->t_cereal,
        //     't_root'                    =>  $request->t_root,
        //     't_veg'                     =>  $request->t_veg,
        //     't_meat'                    =>  $request->t_meat,
        //     't_egg'                     =>  $request->t_egg,
        //     't_fish'                    =>  $request->t_fish,
        //     't_pulse'                   =>  $request->t_pulse,
        //     't_milk'                    =>  $request->t_milk,
        //     't_fruit'                   =>  $request->t_fruit,
        //     't_oil'                     =>  $request->t_oil,
        //     't_sugar'                   =>  $request->t_sugar,
        //     't_chilli'                  =>  $request->t_chilli,

        //     'd_cereal'                  =>  $request->d_cereal,
        //     'd_root'                    =>  $request->d_root,
        //     'd_veg'                     =>  $request->d_veg,
        //     'd_meat'                    =>  $request->d_meat,
        //     'd_egg'                     =>  $request->d_egg,
        //     'd_fish'                    =>  $request->d_fish,
        //     'd_pulse'                   =>  $request->d_pulse,
        //     'd_milk'                    =>  $request->d_milk,
        //     'd_fruit'                   =>  $request->d_fruit,
        //     'd_oil'                     =>  $request->d_oil,
        //     'd_sugar'                   =>  $request->d_sugar,
        //     'd_chilli'                  =>  $request->d_chilli,
        // );
        // if($request->action_type=="add"){
        //     $details_id =  DietaryDetails::create($dietary_details);
        // }
        // else{
        //     DietaryDetails::where('basic_id',$request->id)->update($dietary_details);
        //     $details_id = DietaryDetails::where('basic_id',$request->id)->first();
        // }
        // return $this->successResponse($details_id, Response::HTTP_CREATED);

        $basic_details = [
            'average_score'                      =>  $request->average_score,
            // 'prepared_by'                        =>  $request->prepared_by,
            'remarks'                            =>  $request->remarks,
            // 'endrosed_by'                        =>  $request->endrosed_by,
            'organizationId'                     =>  $request->org_id,
            'dzongkhagId'                        =>  $request->dzo_id,
            'status'                             =>  'Submitted'
        ];
        if($request->action_type=="add"){
            $basic_details = $basic_details+[
                'created_by'                 =>  $request->user_id,
                'created_at'                 =>  date('Y-m-d h:i:s'),
            ];
            $basic = DietaryBasic::create($basic_details);
        }
        else{
            $basic_details = $basic_details+[
                'updated_by'                 =>  $request->user_id,
                'updated_at'                 =>  date('Y-m-d h:i:s')
            ];
            DietaryBasic::where('id',$request->id)->update($basic_details);
            $basic = DietaryBasic::where('id',$request->id)->first();
        }

        if($request->action_type=="add"){
            //Day 1
            $dietary_details = array(
                'basic_id'                  =>  $basic->id,
                'record_date'               =>  $request->record_date1,
                'total_score'               =>  $request->total_score1,
            );
            $dates =  Dietarydates::create($dietary_details);
            foreach($request->items1 as $itms){
                $dietary_details = array(
                    'basic_id'                  =>  $basic->id,
                    'dietary_date_id'           =>  $dates->id,
                    'meal_type'                 =>  $itms['meal'],
                    'cereal'                    =>  $itms['cereal'],
                    'root'                      =>  $itms['root'],
                    'veg'                       =>  $itms['veg'],
                    'meat'                      =>  $itms['meat'],
                    'egg'                       =>  $itms['egg'],
                    'fish'                      =>  $itms['fish'],
                    'pulse'                     =>  $itms['pulse'],
                    'milk'                      =>  $itms['milk'],
                    'fruit'                     =>  $itms['fruit'],
                    'oil'                       =>  $itms['oil'],
                    'sugar'                     =>  $itms['sugar'],
                    'chilli'                    =>  $itms['chilli'],
                );
                $details_id =  DietaryDetails::create($dietary_details);
            }

            //Day 2
            $dietary_details = array(
                'basic_id'                  =>  $basic->id,
                'record_date'               =>  $request->record_date2,
                'total_score'               =>  $request->total_score2,
            );
            $date2 =  Dietarydates::create($dietary_details);
            foreach($request->items2 as $itms){
                $dietary_details = array(
                    'basic_id'                  =>  $basic->id,
                    'dietary_date_id'           =>  $date2->id,
                    'meal_type'                 =>  $itms['meal'],
                    'cereal'                    =>  $itms['cereal'],
                    'root'                      =>  $itms['root'],
                    'veg'                       =>  $itms['veg'],
                    'meat'                      =>  $itms['meat'],
                    'egg'                       =>  $itms['egg'],
                    'fish'                      =>  $itms['fish'],
                    'pulse'                     =>  $itms['pulse'],
                    'milk'                      =>  $itms['milk'],
                    'fruit'                     =>  $itms['fruit'],
                    'oil'                       =>  $itms['oil'],
                    'sugar'                     =>  $itms['sugar'],
                    'chilli'                    =>  $itms['chilli'],
                );
                $details_id =  DietaryDetails::create($dietary_details);
            }

            //Day 3
            $dietary_details = array(
                'basic_id'                  =>  $basic->id,
                'record_date'               =>  $request->record_date3,
                'total_score'               =>  $request->total_score3,
            );
            $date3 =  Dietarydates::create($dietary_details);
            foreach($request->items3 as $itms){
                $dietary_details = array(
                    'basic_id'                  =>  $basic->id,
                    'dietary_date_id'           =>  $date3->id,
                    'meal_type'                 =>  $itms['meal'],
                    'cereal'                    =>  $itms['cereal'],
                    'root'                      =>  $itms['root'],
                    'veg'                       =>  $itms['veg'],
                    'meat'                      =>  $itms['meat'],
                    'egg'                       =>  $itms['egg'],
                    'fish'                      =>  $itms['fish'],
                    'pulse'                     =>  $itms['pulse'],
                    'milk'                      =>  $itms['milk'],
                    'fruit'                     =>  $itms['fruit'],
                    'oil'                       =>  $itms['oil'],
                    'sugar'                     =>  $itms['sugar'],
                    'chilli'                    =>  $itms['chilli'],
                );
                $details_id =  DietaryDetails::create($dietary_details);
            }

            //Day 4
            $dietary_details = array(
                'basic_id'                  =>  $basic->id,
                'record_date'               =>  $request->record_date4,
                'total_score'               =>  $request->total_score4,
            );
            $date4 =  Dietarydates::create($dietary_details);
            foreach($request->items4 as $itms){
                $dietary_details = array(
                    'basic_id'                  =>  $basic->id,
                    'dietary_date_id'           =>  $date4->id,
                    'meal_type'                 =>  $itms['meal'],
                    'cereal'                    =>  $itms['cereal'],
                    'root'                      =>  $itms['root'],
                    'veg'                       =>  $itms['veg'],
                    'meat'                      =>  $itms['meat'],
                    'egg'                       =>  $itms['egg'],
                    'fish'                      =>  $itms['fish'],
                    'pulse'                     =>  $itms['pulse'],
                    'milk'                      =>  $itms['milk'],
                    'fruit'                     =>  $itms['fruit'],
                    'oil'                       =>  $itms['oil'],
                    'sugar'                     =>  $itms['sugar'],
                    'chilli'                    =>  $itms['chilli'],
                );
                $details_id =  DietaryDetails::create($dietary_details);
            }
            //Day 5
            $dietary_details = array(
                'basic_id'                  =>  $basic->id,
                'record_date'               =>  $request->record_date5,
                'total_score'               =>  $request->total_score5,
            );
            $date5 =  Dietarydates::create($dietary_details);
            foreach($request->items5 as $itms){
                $dietary_details = array(
                    'basic_id'                  =>  $basic->id,
                    'dietary_date_id'           =>  $date5->id,
                    'meal_type'                 =>  $itms['meal'],
                    'cereal'                    =>  $itms['cereal'],
                    'root'                      =>  $itms['root'],
                    'veg'                       =>  $itms['veg'],
                    'meat'                      =>  $itms['meat'],
                    'egg'                       =>  $itms['egg'],
                    'fish'                      =>  $itms['fish'],
                    'pulse'                     =>  $itms['pulse'],
                    'milk'                      =>  $itms['milk'],
                    'fruit'                     =>  $itms['fruit'],
                    'oil'                       =>  $itms['oil'],
                    'sugar'                     =>  $itms['sugar'],
                    'chilli'                    =>  $itms['chilli'],
                );
                $details_id =  DietaryDetails::create($dietary_details);
            }
            //Day 6
            $dietary_details = array(
                'basic_id'                  =>  $basic->id,
                'record_date'               =>  $request->record_date6,
                'total_score'               =>  $request->total_score6,
            );
            $date6 =  Dietarydates::create($dietary_details);
            foreach($request->items6 as $itms){
                $dietary_details = array(
                    'basic_id'                  =>  $basic->id,
                    'dietary_date_id'           =>  $date6->id,
                    'meal_type'                 =>  $itms['meal'],
                    'cereal'                    =>  $itms['cereal'],
                    'root'                      =>  $itms['root'],
                    'veg'                       =>  $itms['veg'],
                    'meat'                      =>  $itms['meat'],
                    'egg'                       =>  $itms['egg'],
                    'fish'                      =>  $itms['fish'],
                    'pulse'                     =>  $itms['pulse'],
                    'milk'                      =>  $itms['milk'],
                    'fruit'                     =>  $itms['fruit'],
                    'oil'                       =>  $itms['oil'],
                    'sugar'                     =>  $itms['sugar'],
                    'chilli'                    =>  $itms['chilli'],
                );
                $details_id =  DietaryDetails::create($dietary_details);
            }
            //Day 7
            $dietary_details = array(
                'basic_id'                  =>  $basic->id,
                'record_date'               =>  $request->record_date7,
                'total_score'               =>  $request->total_score7,
            );
            $date7 =  Dietarydates::create($dietary_details);
            foreach($request->items7 as $itms){
                $dietary_details = array(
                    'basic_id'                  =>  $basic->id,
                    'dietary_date_id'           =>  $date7->id,
                    'meal_type'                 =>  $itms['meal'],
                    'cereal'                    =>  $itms['cereal'],
                    'root'                      =>  $itms['root'],
                    'veg'                       =>  $itms['veg'],
                    'meat'                      =>  $itms['meat'],
                    'egg'                       =>  $itms['egg'],
                    'fish'                      =>  $itms['fish'],
                    'pulse'                     =>  $itms['pulse'],
                    'milk'                      =>  $itms['milk'],
                    'fruit'                     =>  $itms['fruit'],
                    'oil'                       =>  $itms['oil'],
                    'sugar'                     =>  $itms['sugar'],
                    'chilli'                    =>  $itms['chilli'],
                );
                $details_id =  DietaryDetails::create($dietary_details);
            }
        }
        return $this->successResponse($details_id, Response::HTTP_CREATED);
    }

    public function getdiatery($org_Id=""){
        if(strpos($org_Id,'_Creater')!==false){
            $response_data = DietaryBasic::where('created_by',explode('_',$org_Id)[0])->get();
        }
        else{
            //list by org wise need to check as and when use
            $response_data = DietaryBasic::where('organizationId',explode('_',$org_Id)[0])->get();
        }
        return $response_data;
    }

    public function getdiateryDetails($id=""){
        $response_data = DietaryBasic::where('id',$id)->first();
        // $response_data->details=DietaryDetails::where('basic_id',$id)->first();
        $dates=Dietarydates::where('basic_id',$id)->get();
        $response_data->dates=$dates;
        foreach($dates as $date){
            $date->details=DietaryDetails::where('basic_id',$id)->where('dietary_date_id',$date['id'])->get();
        }
        return $response_data;
    }

    public function checkdata($date="",$org_id=""){
        $response_data = DietaryBasic::where('date',$date)->where('organizationId',$org_id)->first();
        if($response_data!=null && $response_data!=""){
            return true;
        }
        else{
            return false;
        }
    }

    public function approvereject(Request $request){
        $status='Approved';
        if($request->action_type=="reject"){
            $status='Rejected';
        }
        $basic_details = [
            'approve_reject_remarks'            =>  $request->remarks,
            'status'                            =>  $status,
            'approve_reject_by'                 =>  $request->user_id,
            'approve_reject_at'                 =>  date('Y-m-d h:i:s')
        ];
        DietaryBasic::where('id',$request->id)->update($basic_details);
        $basic = DietaryBasic::where('id',$request->id)->first();
        return $this->successResponse($basic, Response::HTTP_CREATED);
    }

}
