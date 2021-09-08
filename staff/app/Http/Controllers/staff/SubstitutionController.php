<?php

namespace App\Http\Controllers\staff;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\staff\SubstitutionModel;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;

class SubstitutionController extends Controller{
    use ApiResponser;
    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
    }
    public function savestaff(Request $request){
        $rules = [
            'cid'                   =>  'required  ',
            'name'                  =>  'required  ',
            'dob'                   =>  'required  ',
            'gender'                =>  'required  ',
            'dzongkhag'             =>  'required  ',
            'contact'               =>  'required  ',
            'email'                 =>  'required  ',
            'qualification'         =>  'required  ',
        ];
        $customMessages = [
            'cid.required'              => 'Please provide CID',
            'name.required'             => 'name is required',
            'dob.required'              => 'dob is required',
            'gender.required'           => 'gender is required',
            'dzongkhag.required'        => 'dzongkhag is required',
            'contact.required'          => 'contact is required',
            'email.required'            => 'email is required',
            'qualification.required'    => 'qualification is required',
        ];
        $this->validate($request, $rules,$customMessages);
        $data =[
            'cid'               =>  $request->cid,
            'name'              =>  $request->name,
            'dob'               =>  $request->dob,
            'gender'            =>  $request->gender,
            'dzongkhag'         =>  $request->dzongkhag,
            'contact'           =>  $request->contact,
            'email'             =>  $request->email,
            'qualification'     =>  $request->qualification,
            'created_by'        =>  $request->user_id,
            'created_at'        =>  date('Y-m-d h:i:s'),
        ];
        $response_data = SubstitutionModel::create($data);
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }
}
