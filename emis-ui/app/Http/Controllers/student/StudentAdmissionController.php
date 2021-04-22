<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use App\Helper\EmisService;
use App\Traits\ServiceHelper;
use Illuminate\Http\Request;
use App\Traits\AuthUser;

class StudentAdmissionController extends Controller{
    use ServiceHelper;
    use AuthUser;
    public $apiService;
    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }
    public function saveStudentDetails(Request $request){
        $rules = [
            'snationality'              => 'required',
            'cid_passport'              => 'required',
            'first_name'                => 'required',
            'dob'                       => 'required',
            'sex_id'                    => 'required',
            'mother_tongue'             => 'required',
            'attachments'               => 'required',
            
        ];
        $customMessages = [
            'snationality.required'             => 'This field is required',
            'cid_passport.required'             => 'This field is required',
            'first_name.required'               => 'This field is required',
            'dob.required'                      => 'This field is required',
            'sex_id.required'                   => 'This field is required',
            'mother_tongue.required'            => 'This field is required',
            'attachments.required'              => 'This field is required',
        ];
        $this->validate($request, $rules, $customMessages);

        $file = $request->attachments;
        $path="";
        $file_store_path=config('services.constant.file_stored_base_path').'studentPhotoes';
        if($file!=null && $file!=""){
            if(!is_dir($file_store_path)){
                mkdir($file_store_path,0777,TRUE);
            }
            $file_name = time().'_' .$file->getClientOriginalName();
            move_uploaded_file($file,$file_store_path.'/'.$file_name);
            $path=$file_store_path.'/'.$file_name;
        }
        $data =[
            'snationality'              =>  $request->snationality,
            'cid_passport'              =>  $request->cid_passport,
            'first_name'                =>  $request->first_name,
            'middle_name'               =>  $request->middle_name,
            'last_name'                 =>  $request->last_name,
            'dob'                       =>  $request->dob,
            'sex_id'                    =>  $request->sex_id,
            'dzongkhag'                 =>  $request->dzongkhag, 
            'gewog'                     =>  $request->gewog, 
            'village_id'                =>  $request->village_id, 
            'fulladdress'               =>  $request->fulladdress, 
            'mother_tongue'             =>  $request->mother_tongue, 
            'attachments'               =>  $path, 
            'user_id'                   =>  $this->userId() 
        ];
        $response_data= $this->apiService->createData('emis/students/admission/saveStudentDetails', $data);
        return $response_data;
    }
}
