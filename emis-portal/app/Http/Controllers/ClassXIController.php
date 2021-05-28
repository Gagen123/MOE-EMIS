<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Helper\EmisService;

use function PHPSTORM_META\type;

// use Illuminate\Http\Response;

class ClassXIController extends Controller
{
    public $apiService;
    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }
    //
    public function savedetailsNotEnrolledStd(Request $request){
        // dd($request);
        $rules = [
            // 'dzongkhag'                 => 'required',
            // 'school'                    => 'required',
            // 'class'                     => 'required',
            // 'stream'                    => 'required',
            'dateOfapply'               => 'required',
            // 'student_type'              => 'student_type',
            
        ];
        $customMessages = [
            // 'dzongkhag.required'          => 'This field is required',
            // 'school.required'             => 'This field is required',
            // 'class.required'              => 'This field is required',
            // 'stream.required'             => 'This field is required',
            // 'dateOfapply.required'        => 'This field is required',
            'student_type.required'       => 'This field is required',
        ];
        $this->validate($request, $rules, $customMessages);

        $data =[
            'OrgOrganizationId'          =>$request->OrgOrganizationId,
            'cid_passport'               =>$request->cid_passport,
            'gender'                     =>$request->gender,
            'Name'                        =>$request->Name,
            'student_type'               =>$request->student_type,
            'dzongkhag'                  =>  $request->dzongkhag,
            'school'                     =>  $request->school,
            'class'                      =>  $request->class,
            'stream'                     =>  $request->stream,
            'dateOfapply'                =>  $request->dateOfapply,
            'remarks'                    =>  $request->remarks,
        ];
        $response_data= $this->apiService->createData('emis/students/admission/savedetailsNotEnrolledStd', $data);
        return $response_data;

    }
}
