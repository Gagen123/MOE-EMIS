<?php

namespace App\Http\Controllers\establishment;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponser;
use Illuminate\Support\Facades\DB;
use App\Models\ContactDetails;
use App\Models\establishment\HeadQuaterDetails;

class HeadQuaterController extends Controller
{
    use ApiResponser;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
    }
    /**
     * method to save basic details in draft
     */
    public function saveBasicDetails(Request $request){
        $id = $request->id;
        if($id != null){
            $basic = [
                'organizationId'         =>  1,
                'zestAgencyCode'         =>  $request['agencyCode'],
                'agencyName'             =>  $request['agencyName'],
                'chiwogId'               =>  1,
                'organizationType'       =>  $request['agencyType'],
                'status'                 =>  $request['status'],
                'updated_by'             =>  $request->user_id,
                'created_at'             =>  date('Y-m-d h:i:s')
                ];

                $basicDetails = HeadQuaterDetails::where('id', $id)->update($basic);
                return $this->successResponse($basicDetails, Response::HTTP_CREATED);
        }else{
            $basic = [
                'organizationId'         =>  1,
                'zestAgencyCode'         =>  $request['agencyCode'],
                'agencyName'             =>  $request['agencyName'],
                'chiwogId'               =>  1,
                'organizationType'       =>  $request['agencyType'],
                'status'                 =>  $request['status'],
                'created_by'             =>  $request->user_id,
                'created_at'             =>  date('Y-m-d h:i:s')
                ];
                $basicDetails = HeadQuaterDetails::create($basic);
                return $this->successResponse($basicDetails, Response::HTTP_CREATED);
        }
    }

    /**
     * method to load basic details
     */
    public function loadBasicDetails($user_id=""){
        return $this->successResponse(HeadQuaterDetails::where('created_by',$user_id)->where('status','Pending')->first());
    }

    /**
     * method to save contact details
     */
    public function saveContactDetails(Request $request){
        $contactDetails = $request->users;

        foreach ($contactDetails as $con){
            $contact = array(
                'organizationId'    =>  1,
                'contactTypeId'     =>  $con['names'],
                'phone'             =>  $con['phone'],
                'fax'               =>  $con['fax'],
                'mobile'            =>  $con['mobile'],
                'email'             =>  $con['email'],
                'type'              =>  1
            );            
            $conn = ContactDetails::create($contact);
            
            $array = ['status' => 'submitted'];
            DB::table('head_quater_details')->where('created_by',$request->user_id)->update($array);
        }
        return $this->successResponse($conn, Response::HTTP_CREATED);
    }
}
