<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\DietaryBasic;
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
        $basic_details = [
           'score'                      =>  $request->total_score,
           'date'                       =>  $request->record_date,
           'remarks'                    =>  $request->remarks,
           'organizationId'             =>  $request->org_id,
        ];
        if($request->action_type=="add"){
            $basic_details = $basic_details+[
                'created_by'                 =>  $request->user_id,
                'created_at'                 =>  date('Y-m-d h:i:s')
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
        $dietary_details = array(
            'basic_id'                  =>  $basic->id,
            'b_cereal'                  =>  $request->b_cereal,
            'b_root'                    =>  $request->b_root,
            'b_veg'                     =>  $request->b_veg,
            'b_meat'                    =>  $request->b_meat,
            'b_egg'                     =>  $request->b_egg,
            'b_fish'                    =>  $request->b_fish,
            'b_pulse'                   =>  $request->b_pulse,
            'b_milk'                    =>  $request->b_milk,
            'b_fruit'                   =>  $request->b_fruit,
            'b_oil'                     =>  $request->b_oil,
            'b_sugar'                   =>  $request->b_sugar,
            'b_chilli'                  =>  $request->b_chilli,

            'l_cereal'                  =>  $request->l_cereal,
            'l_root'                    =>  $request->l_root,
            'l_veg'                     =>  $request->l_veg,
            'l_meat'                    =>  $request->l_meat,
            'l_egg'                     =>  $request->l_egg,
            'l_fish'                    =>  $request->l_fish,
            'l_pulse'                   =>  $request->l_pulse,
            'l_milk'                    =>  $request->l_milk,
            'l_fruit'                   =>  $request->l_fruit,
            'l_oil'                     =>  $request->l_oil,
            'l_sugar'                   =>  $request->l_sugar,
            'l_chilli'                  =>  $request->l_chilli,

            't_cereal'                  =>  $request->t_cereal,
            't_root'                    =>  $request->t_root,
            't_veg'                     =>  $request->t_veg,
            't_meat'                    =>  $request->t_meat,
            't_egg'                     =>  $request->t_egg,
            't_fish'                    =>  $request->t_fish,
            't_pulse'                   =>  $request->t_pulse,
            't_milk'                    =>  $request->t_milk,
            't_fruit'                   =>  $request->t_fruit,
            't_oil'                     =>  $request->t_oil,
            't_sugar'                   =>  $request->t_sugar,
            't_chilli'                  =>  $request->t_chilli,

            'd_cereal'                  =>  $request->d_cereal,
            'd_root'                    =>  $request->d_root,
            'd_veg'                     =>  $request->d_veg,
            'd_meat'                    =>  $request->d_meat,
            'd_egg'                     =>  $request->d_egg,
            'd_fish'                    =>  $request->d_fish,
            'd_pulse'                   =>  $request->d_pulse,
            'd_milk'                    =>  $request->d_milk,
            'd_fruit'                   =>  $request->d_fruit,
            'd_oil'                     =>  $request->d_oil,
            'd_sugar'                   =>  $request->d_sugar,
            'd_chilli'                  =>  $request->d_chilli,
        );
        if($request->action_type=="add"){
            $details_id =  DietaryDetails::create($dietary_details);
        }
        else{
            DietaryDetails::where('basic_id',$request->id)->update($dietary_details);
            $details_id = DietaryDetails::where('basic_id',$request->id)->first();
        }
        return $this->successResponse($details_id, Response::HTTP_CREATED);
    }
    public function getdiatery($org_Id=""){
        $response_data = DietaryBasic::where('organizationId',$org_Id)->get();
        return $response_data;
    }

    public function getdiateryDetails($id=""){
        $response_data = DietaryBasic::where('id',$id)->first();
        $response_data->details=DietaryDetails::where('basic_id',$id)->first();
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

}
