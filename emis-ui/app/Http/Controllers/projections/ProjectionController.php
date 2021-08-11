<?php

namespace App\Http\Controllers\projections;

use App\Helper\EmisService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\AuthUser;
use App\Traits\ServiceHelper;

class ProjectionController extends Controller{
    use AuthUser;
    use ServiceHelper;
    public $apiService;
    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }

    public function loadEccdChildren($type="",$dzo_id=""){
        // $orgclassStream=[];

        // $orgclassStream= $this->apiService->getListData('emis/common_services/loadClassStreamSectionIds/ECCD/'.$type.'/'.$dzo_id);
        // $param = http_build_query(json_decode($orgclassStream)->data);
        // if($param!=""){
        //     $orgclassStream= $this->apiService->getListData('emis/common_services/loadStudents/ECCD/'.$param);
        //     if($orgclassStream!=null && $orgclassStream!=""){
        //         $response_data['total_data']=json_decode($orgclassStream);
        //     }
        // }
        $response_data=[];
        $publicOrgStream= $this->apiService->getListData('emis/common_services/loadClassStreamSectionIds/ECCD/Public/'.$dzo_id);
        $public = http_build_query(json_decode($publicOrgStream)->data);
        if($public!=""){
            $public_data= $this->apiService->getListData('emis/common_services/loadStudents/ECCD/'.$public);
            if($public_data!=null && $public_data!=""){
                $response_data['public_data']=json_decode($public_data);
            }
            else{
                $response_data['public_data'][0]=['malecount'=>0,'femalecount'=>0,'totalstd'=>0];
            }
        }else{
            $response_data['public_data'][0]=['malecount'=>0,'femalecount'=>0,'totalstd'=>0];
        }

        $privateOrgStream= $this->apiService->getListData('emis/common_services/loadClassStreamSectionIds/ECCD/Private/'.$dzo_id);
        $private = http_build_query(json_decode($privateOrgStream)->data);
        if($private!=""){
            $private_data= $this->apiService->getListData('emis/common_services/loadStudents/ECCD/'.$private);
            if($private_data!=null && $private_data!=""){
                $response_data['private_data']=json_decode($private_data);
            }
            else{
                $response_data['private_data'][0]=['malecount'=>0,'femalecount'=>0,'totalstd'=>0];
            }
        }else{
            $response_data['private_data'][0]=['malecount'=>0,'femalecount'=>0,'totalstd'=>0];
        }

        $ngoOrgStream= $this->apiService->getListData('emis/common_services/loadClassStreamSectionIds/ECCD/NGO/'.$dzo_id);
        $ngo = http_build_query(json_decode($ngoOrgStream)->data);
        if($ngo!=""){
            $ngo_data= $this->apiService->getListData('emis/common_services/loadStudents/ECCD/'.$ngo);
            if($ngo_data!=null && $ngo_data!=""){
                $response_data['ngo_data']=json_decode($ngo_data);
            }
            else{
                $response_data['ngo_data'][0]=['malecount'=>0,'femalecount'=>0,'totalstd'=>0];
            }
        }else{
            $response_data['ngo_data'][0]=['malecount'=>0,'femalecount'=>0,'totalstd'=>0];
        }

        $coorporateOrgStream= $this->apiService->getListData('emis/common_services/loadClassStreamSectionIds/ECCD/Coorporate/'.$dzo_id);
        $coorporate = http_build_query(json_decode($coorporateOrgStream)->data);
        if($coorporate!=""){
            $coorporate_data= $this->apiService->getListData('emis/common_services/loadStudents/ECCD/'.$coorporate);
            if($coorporate_data!=null && $coorporate_data!=""){
                $response_data['coorporate_data']=json_decode($coorporate_data);
            }
            else{
                $response_data['coorporate_data'][0]=['malecount'=>0,'femalecount'=>0,'totalstd'=>0];
            }
        }else{
            $response_data['coorporate_data'][0]=['malecount'=>0,'femalecount'=>0,'totalstd'=>0];
        }

        return $response_data;
    }

    public function loadStudents($dzo_id=""){
        $response_data=[];
        //public school
        $publicOrgStream= $this->apiService->getListData('emis/common_services/loadClassStreamSectionIds/School/Public/'.$dzo_id);
        $public = http_build_query(json_decode($publicOrgStream)->data);
        if($public!=""){
            $public_data= $this->apiService->getListData('emis/common_services/loadStudents/School/'.$public);
            if($public_data!=null && $public_data!=""){
                $response_data['public_data']=json_decode($public_data);
            }
            else{
                $response_data['public_data'][0]=['malecount'=>0,'femalecount'=>0,'totalstd'=>0];
            }
        }else{
            $response_data['public_data'][0]=['malecount'=>0,'femalecount'=>0,'totalstd'=>0];
        }
        //private school
        $privateOrgStream= $this->apiService->getListData('emis/common_services/loadClassStreamSectionIds/School/Private/'.$dzo_id);
        $private = http_build_query(json_decode($privateOrgStream)->data);
        if($private!=""){
            $private_data= $this->apiService->getListData('emis/common_services/loadStudents/School/'.$private);
            if($private_data!=null && $private_data!=""){
                $response_data['private_data']=json_decode($private_data);
            }
            else{
                $response_data['private_data'][0]=['malecount'=>0,'femalecount'=>0,'totalstd'=>0];
            }
        }else{
            $response_data['private_data'][0]=['malecount'=>0,'femalecount'=>0,'totalstd'=>0];
        }

        //public higher secondaty
        $higherOrgStream= $this->apiService->getListData('emis/common_services/loadClassStreamSectionIds/School/Public_HSS/'.$dzo_id);
        $pub_higher = http_build_query(json_decode($higherOrgStream)->data);
        if($pub_higher!=""){
            $public_higher_data= $this->apiService->getListData('emis/common_services/loadStudents/School/'.$pub_higher);
            if($public_higher_data!=null && $public_higher_data!=""){
                $response_data['public_higher_data']=json_decode($public_higher_data);
            }
            else{
                $response_data['public_higher_data'][0]=['malecount'=>0,'femalecount'=>0,'totalstd'=>0];
            }
        }else{
            $response_data['public_higher_data'][0]=['malecount'=>0,'femalecount'=>0,'totalstd'=>0];
        }

        //public Middle secondaty
        $public_middleOrgStream= $this->apiService->getListData('emis/common_services/loadClassStreamSectionIds/School/Public_MSS/'.$dzo_id);
        $public_middle = http_build_query(json_decode($public_middleOrgStream)->data);
        if($public_middle!=""){
            $public_middle_data= $this->apiService->getListData('emis/common_services/loadStudents/School/'.$public_middle);
            if($public_middle_data!=null && $public_middle_data!=""){
                $public_middle_data['public_middle_data']=json_decode($public_middle_data);
            }
            else{
                $response_data['public_middle_data'][0]=['malecount'=>0,'femalecount'=>0,'totalstd'=>0];
            }
        }else{
            $response_data['public_middle_data'][0]=['malecount'=>0,'femalecount'=>0,'totalstd'=>0];
        }
        //public Lower secondaty
         $public_lowerOrgStream= $this->apiService->getListData('emis/common_services/loadClassStreamSectionIds/School/Public_LSS/'.$dzo_id);
         $public_lower = http_build_query(json_decode($public_lowerOrgStream)->data);
         if($public_lower!=""){
             $public_lower_data= $this->apiService->getListData('emis/common_services/loadStudents/School/'.$public_lower);
             if($public_lower_data!=null && $public_lower_data!=""){
                 $response_data['public_lower_data']=json_decode($public_lower_data);
             }
             else{
                 $response_data['public_lower_data'][0]=['malecount'=>0,'femalecount'=>0,'totalstd'=>0];
             }
         }else{
             $response_data['public_lower_data'][0]=['malecount'=>0,'femalecount'=>0,'totalstd'=>0];
         }

         //private higher secondaty
        $private_higherOrgStream= $this->apiService->getListData('emis/common_services/loadClassStreamSectionIds/School/Private_HSS/'.$dzo_id);
        $private_higher = http_build_query(json_decode($private_higherOrgStream)->data);
        if($private_higher!=""){
            $private_higher_data= $this->apiService->getListData('emis/common_services/loadStudents/School/'.$private_higher);
            if($private_higher_data!=null && $private_higher_data!=""){
                $response_data['private_higher_data']=json_decode($private_higher_data);
            }
            else{
                $response_data['private_higher_data'][0]=['malecount'=>0,'femalecount'=>0,'totalstd'=>0];
            }
        }else{
            $response_data['private_higher_data'][0]=['malecount'=>0,'femalecount'=>0,'totalstd'=>0];
        }

        //public Middle secondaty
        $public_middleOrgStream= $this->apiService->getListData('emis/common_services/loadClassStreamSectionIds/School/Public_MSS/'.$dzo_id);
        $public_middle = http_build_query(json_decode($public_middleOrgStream)->data);
        if($public_middle!=""){
            $public_middle_data= $this->apiService->getListData('emis/common_services/loadStudents/School/'.$public_middle);
            if($public_middle_data!=null && $public_middle_data!=""){
                $public_middle_data['private_middle_data']=json_decode($public_middle_data);
            }
            else{
                $response_data['private_middle_data'][0]=['malecount'=>0,'femalecount'=>0,'totalstd'=>0];
            }
        }else{
            $response_data['private_middle_data'][0]=['malecount'=>0,'femalecount'=>0,'totalstd'=>0];
        }
        //private Lower secondaty
         $private_lowerOrgStream= $this->apiService->getListData('emis/common_services/loadClassStreamSectionIds/School/Public_LSS/'.$dzo_id);
         $private_lower = http_build_query(json_decode($private_lowerOrgStream)->data);
         if($private_lower!=""){
             $private_lower_data= $this->apiService->getListData('emis/common_services/loadStudents/School/'.$private_lower);
             if($private_lower_data!=null && $private_lower_data!=""){
                 $response_data['private_lower_data']=json_decode($private_lower_data);
             }
             else{
                 $response_data['private_lower_data'][0]=['malecount'=>0,'femalecount'=>0,'totalstd'=>0];
             }
         }else{
             $response_data['private_lower_data'][0]=['malecount'=>0,'femalecount'=>0,'totalstd'=>0];
         }

        return $response_data;
    }
}
