<?php

namespace App\Http\Controllers\student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helper\EmisService;
use App\Traits\ServiceHelper;
use App\Traits\AuthUser;
use Exception;
use Maatwebsite\Excel\Facades\Excel;
use stdClass;

class ExternalDataImputController extends Controller
{
    //
    use ServiceHelper;
    use AuthUser;
    public $apiService;

    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }
    public function saveImported(Request $request){
        $files = $request->attachments;
        $file_data=[];
        $file_path="";
        if($request->input_type=="Excel" && $files!=null && $files!=""){
            try{
                if(sizeof($files)>0){
                    $file_store_path=config('services.constant.file_stored_base_path').'InstituteImportedData';
                    if(sizeof($files)>0 && !is_dir($file_store_path)){
                        mkdir($file_store_path,0777,TRUE);
                    }
                    foreach($files as $index => $file){
                        $theArray = Excel::toArray(new stdClass(), $file);
                        foreach($theArray[0] as $index =>$arrayfile){
                            if($index!=0){
                                array_push($file_data,$arrayfile);
                                $file_name = time().'_' .$file->getClientOriginalName();
                                move_uploaded_file($file,$file_store_path.'/'.$file_name);
                                $file_path=$file_store_path.'/'.$file_name;
                            }
                        }
                    }
                }
            }catch(Exception $e){
                dd('ex: ',$e);
            }
        }
        else if($request->input_type!="Excel" && $request->type == "institutes"){
            $rules = [
                'collegeName'               => 'required',
                'dzongkhag'                 => 'required',
                'institutes_type'           => 'required',
                'own_by'                    => 'required',
            ];
            $customMessages = [
                'collegeName.required'     => 'This field is required',
                'dzongkhag.required'       => 'This field is required',
                'institutes_type.required' => 'This field is required',
                'remarks.required'         => 'This field is required',
                'own.required'             => 'This field is required',
            ];
            $this->validate($request, $rules, $customMessages);
        }
        $request['user_id'] = $this->userId();
        $request['file_data'] = $file_data;
        $request['file_path'] = $file_path;
        $data = $request->all();

        $response_data= $this->apiService->createData('emis/students/ExternalDataImport/saveImported', $data);
        return $response_data;

    }
    public function loadInstitues($param="",$model=""){
        $loadData = $this->apiService->listData('emis/students/ExternalDataImport/loadInstitues/'.$param.'/'.$model);
        return $loadData;

    }

    public function updateExcelfile($type="",$model=""){
        $loadData = $this->apiService->listData('emis/students/ExternalDataImport/updateExcelfile/'.$type.'/'.$model.'__'.$this->userId());
        return $loadData;
    }
}
