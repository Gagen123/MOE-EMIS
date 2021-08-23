<?php

namespace App\Http\Controllers\organization;

use Session;
use GuzzleHttp\Client;
use App\Helper\EmisService;
use App\Traits\ServiceHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\AuthUser;
use Illuminate\Support\Facades\Storage;

class CompoundDetailsController extends Controller
{
    //
    use AuthUser;
    use ServiceHelper;
    public $apiService;

    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    } 

    public function saveSchoolCompundDetails(Request $request){
           //   $file = $request->attachments;
    //    dd($file);
        $files = $request->attachments;
        $filenames = $request->attachmentname;
        $attachment_details=[];
        $file_store_path=config('services.constant.file_stored_base_path').'ThramAndPegInfo';
        if($files!=null && $files!=""){
            if(sizeof($files)>0 && !is_dir($file_store_path)){
                mkdir($file_store_path,0777,TRUE);
            }
            if(sizeof($files)>0){
                foreach($files as $index => $file){
                    $file_name = time().'_' .$file->getClientOriginalName();
                    move_uploaded_file($file,$file_store_path.'/'.$file_name);
                    array_push($attachment_details,
                        array(
                            'path'                   =>  $file_store_path,
                            'original_name'          =>  $file_name,
                            'user_defined_name'      =>  $filenames[$index],
                        )
                    );
                }
            }
        }
        $rules = [
            'thramno'               =>  'required',
            'plotno'                =>  'required',
            'sizecompound'          =>  'required',
            'status'                =>  'required',
            'statusofplay'          =>  'required',
           

        ];
        $customMessages = [
            'thramno.required'                  => 'thramno is required',
            'plotno.required'                   => 'plotno is required',
            'sizecompound.required'             => 'sizecompound is required',
            'status.required'                   => 'agriculturalarea is required',
            'statusofplay.required'             => 'Select Play ground area status is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $comp =[
            'organizationId'                =>  $this->getWrkingAgencyId(),
            'thramno'                       =>  $request['thramno'],
            'plotno'                        =>  $request['plotno'],
            'attachment_details'            =>  $attachment_details,
            'sizecompound'                  =>  $request['sizecompound'],
            'sizeplayground'                =>  $request['sizeplayground'],
            'playgroundused'                =>  $request['playgroundused'],
            'status'                        =>  $request['status'],
            'statusofplay'                  =>  $request['statusofplay'],
            'agriculturalarea'              =>  $request['agriculturalarea'],
            'areaused'                      =>  $request['areaused'],
            'programType'                   =>  $request['programType'],
            'ownership'                     =>  $request['ownership'],
            'id'                            =>  $request['id'],
            'user_id'                       =>  $this->userId()
        ];
        // dd( $comp);
      
        $response_data= $this->apiService->createData('emis/organization/compoundDetails/saveSchoolCompundDetails', $comp);
        return $response_data;
       
    }
    // public function loadcompoundareadetials($org_id=""){
    //     //  dd('m here');
    //     $list = $this->apiService->listData('emis/organization/compoundDetails/loadcompoundareadetials'.$org_id);
    //     return $list;
    // }
    public function loadcompoundareadetials(){
      //  dd('from UI');
        $orgId=$this->getWrkingAgencyId();
        $data = $this->apiService->listData('emis/organization/compoundDetails/loadcompoundareadetials/'.$orgId);
        return $data;
    }

    public function getEditCompoundDetail($compId=""){
        //  dd('from UI');
        //  $orgId=$this->getWrkingAgencyId();
          $data = $this->apiService->listData('emis/organization/compoundDetails/getEditCompoundDetail/'.$compId);
          return $data;
    }

    public function deleteFile($full_path="",$id=""){
       // dd($id);
        $full_path=str_replace('SSS','/',$full_path);
        $headers = ['Content-Type: application/pdf'];
        $file_name = explode('/',$full_path);
        $finel_name = end($file_name);
        $response_data="";
        if (file_exists($full_path)){
            unlink($full_path);
            $response_data = $this->apiService->deleteData("emis/organization/compoundDetails/deleteFile", $id);
        }
      
        return $response_data;
    }
    

}
