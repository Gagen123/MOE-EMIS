<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use App\Traits\ApiResponser;
use App\Models\Masters\Level;
use App\Models\OrganizationDetails;
use App\Models\OrganizationClassStream;
use App\Models\OrganizationProprietorDetails;
use App\Models\establishment\HeadQuaterDetails;
use App\Models\generalInformation\SectionDetails;
use Illuminate\Support\Facades\DB;
use App\Models\OrgProfile;
use App\Models\Masters\Classes;
use App\Models\generalInformation\Locations;
use App\Models\OrganizationFeedingDetails;
use App\Models\ContactDetails;
use App\Models\DepartmentModel;
use App\Models\generalInformation\Projection;

class LoadOrganizationController extends Controller{
    use ApiResponser;
    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
    }

    public function loadOrgList($type="", $id=""){
        $response_data="";
        if($type=="userworkingagency"){
            $response_data=OrganizationDetails::where('id',$id)->wherein('category',['public_school','public_eccd','public_ecr'])
            ->where('status','1')
            ->select( 'id','name','levelId','dzongkhagId')->get();
        }
        if($type=="public_eccd"){
            $response_data=OrganizationDetails::where('dzongkhagId',$id)->wherein('category',['public_eccd','private_eccd'])->get();
        }
        if($type=="school" || $type=="ce"){
            $response_data=OrganizationDetails::where('dzongkhagId',$id)->wherein('category',['public_school','private_school'])->get();
        }
        if($type=="ECR"){
            $response_data=OrganizationDetails::where('dzongkhagId',$id)->where('category','public_ecr')->get();
        }
        if($type=="gewoggwise"){
            $response_data=OrganizationDetails::where('gewogId',$id)->wherein('category',['public_school','public_eccd','public_ecr'])->select( 'id','name','levelId','dzongkhagId')->get();
        }
        if($type=="dzongkhagwise" || $type=="userdzongkhagwise"){
            $response_data=OrganizationDetails::where('dzongkhagId',$id)->wherein('category',['public_school','public_eccd','public_ecr'])->get();
        }

        if($type=="allorganizationList"){
            if($id=="allData"){
                $response_data=OrganizationDetails::all();
            }
            else{        // dd($request);
                $response_data=OrganizationDetails::select( 'id','name','levelId','dzongkhagId')->get();
            }
        }
        if(strpos($type,'admission_dzongkhagwise')!==false){
            $category=explode('__',$type)[1];
            if($category=="ECCD"){
                $response_data=OrganizationDetails::wherein('category',['private_eccd','public_eccd'])->where('dzongkhagId',$id)->get();
            }else{
                $response_data=OrganizationDetails::wherein('category',['private_school','public_school'])->where('dzongkhagId',$id)->get();
            }
        }
        if($type=="private"){
            $response_data=OrganizationDetails::wherein('category',['private_school','private_eccd'])->where('dzongkhagId',$id)->get();
        }
        if($response_data!=null && $response_data!="" && sizeof($response_data) >0){
            foreach($response_data as $res){
                if($res['levelId']!=null && $res['levelId']!=""){
                    $lev=Level::where('id',$res['levelId'])->first();
                    if($lev!=null && $lev!=""){
                        $res->name=$res->name.' '.$lev->name;
                    }
                }
            }
        }

        //added by Saru to get eccd list
        if($type=="eccd"){
            if($id=="ALL"){
              
             //   $response_data=OrganizationDetails::wherein('category',['private_eccd','public_eccd'])->get();
             $response_data = DB::select(" SELECT 
             COUNT(CASE WHEN category = 'public_eccd' THEN 1 END) AS Public_ECCD,
             COUNT(CASE WHEN category = 'private_eccd' THEN 1 END) AS Private_ECCD
             FROM organization_details");
            }else{
              //  $response_data=OrganizationDetails::wherein('category',['private_eccd','public_eccd'])->where('dzongkhagId',$id)->get();
              $response_data = DB::select(" SELECT 
              COUNT(CASE WHEN category = 'public_eccd' THEN 1 END) AS Public_ECCD,
              COUNT(CASE WHEN category = 'private_eccd' THEN 1 END) AS Private_ECCD
              FROM organization_details
              WHERE dzongkhagId = '".$id."'");
            }
        }
        //to get both private and public School
        if($type=="School"){
            if($id=="ALL"){
                $response_data = DB::select(" SELECT a.category,
                COUNT(CASE WHEN l.name = 'Lower Secondary School' THEN 1 END) AS Lower_Secondary_School,
                COUNT(CASE WHEN l.name = 'Primary' THEN 2 END) AS primary_School,
                COUNT(CASE WHEN l.name = 'Middle Secondary School' THEN 3 END) AS Middle_secondary_school,
                COUNT(CASE WHEN l.name = 'Higher Secondary School' THEN 4 END) AS Higher_Secondary_School,
                SUM(CASE WHEN a.category = 'private_school' OR a.category = 'public_school' THEN 1
                    ELSE 0 END) AS Total
                FROM `organization_details` a
                LEFT JOIN `level` l ON l.id = a.levelId
                WHERE category = 'public_school' OR category = 'private_school'
                GROUP BY a.category;");
            } else {
                $response_data = DB::select("SELECT a.category,
                COUNT(CASE WHEN l.name = 'Lower Secondary School' THEN 1 END) AS Lower_Secondary_School,
                COUNT(CASE WHEN l.name = 'Primary' THEN 2 END) AS primary_School,
                COUNT(CASE WHEN l.name = 'Middle Secondary School' THEN 3 END) AS Middle_secondary_school,
                COUNT(CASE WHEN l.name = 'Higher Secondary School' THEN 4 END) AS Higher_Secondary_School,
                SUM(CASE WHEN a.category = 'private_school' OR a.category = 'public_school' THEN 1
                    ELSE 0 END) AS Total
                FROM `organization_details` a
                LEFT JOIN `level` l ON l.id = a.levelId
                WHERE (category = 'public_school' OR category = 'private_school') AND dzongkhagId = '".$id."'
                GROUP BY a.category");
               
            }
        }
        if($type=="SEN"){
            if($id=="ALL"){
                $response_data = DB::select(" SELECT a.category,
                COUNT(CASE WHEN l.name = 'Lower Secondary School' THEN 1 END) AS Lower_Secondary_School,
                COUNT(CASE WHEN l.name = 'Primary' THEN 2 END) AS primary_School,
                COUNT(CASE WHEN l.name = 'Middle Secondary School' THEN 3 END) AS Middle_secondary_school,
                COUNT(CASE WHEN l.name = 'Higher Secondary School' THEN 4 END) AS Higher_Secondary_School,
                SUM(CASE WHEN a.category = 'private_school' OR a.category = 'public_school' THEN 1
                    ELSE 0 END) AS Total
                FROM `organization_details` a
                LEFT JOIN `level` l ON l.id = a.levelId
                WHERE (category = 'public_school' OR category = 'private_school') AND isSenSchool = 1
                GROUP BY a.category;");
            } else {
                $response_data = DB::select("SELECT a.category,
                COUNT(CASE WHEN l.name = 'Lower Secondary School' THEN 1 END) AS Lower_Secondary_School,
                COUNT(CASE WHEN l.name = 'Primary' THEN 2 END) AS primary_School,
                COUNT(CASE WHEN l.name = 'Middle Secondary School' THEN 3 END) AS Middle_secondary_school,
                COUNT(CASE WHEN l.name = 'Higher Secondary School' THEN 4 END) AS Higher_Secondary_School,
                SUM(CASE WHEN a.category = 'private_school' OR a.category = 'public_school' THEN 1
                    ELSE 0 END) AS Total
                FROM `organization_details` a
                LEFT JOIN `level` l ON l.id = a.levelId
                WHERE (category = 'public_school' OR category = 'private_school') AND isSenSchool = 1 AND dzongkhagId = '".$id."'
                GROUP BY a.category");
               
            }
        }
        if($type=="ECR"){
            if($id=="ALL"){
                $response_data = DB::select(" SELECT a.category,
                COUNT(CASE WHEN l.name = 'Lower Secondary School' THEN 1 END) AS Lower_Secondary_School,
                COUNT(CASE WHEN l.name = 'Primary' THEN 2 END) AS primary_School,
                COUNT(CASE WHEN l.name = 'Middle Secondary School' THEN 3 END) AS Middle_secondary_school,
                COUNT(CASE WHEN l.name = 'Higher Secondary School' THEN 4 END) AS Higher_Secondary_School,
                SUM(CASE WHEN a.category = 'public_ecr'  THEN 1
                    ELSE 0 END) AS Total
                FROM `organization_details` a
                LEFT JOIN `level` l ON l.id = a.levelId
                WHERE category = 'public_ecr' 
                GROUP BY a.category;");
            } else {
                $response_data = DB::select("SELECT a.category,
                COUNT(CASE WHEN l.name = 'Lower Secondary School' THEN 1 END) AS Lower_Secondary_School,
                COUNT(CASE WHEN l.name = 'Primary' THEN 2 END) AS primary_School,
                COUNT(CASE WHEN l.name = 'Middle Secondary School' THEN 3 END) AS Middle_secondary_school,
                COUNT(CASE WHEN l.name = 'Higher Secondary School' THEN 4 END) AS Higher_Secondary_School,
                SUM(CASE WHEN a.category = 'public_ecr'  THEN 1
                    ELSE 0 END) AS Total
                FROM `organization_details` a
                LEFT JOIN `level` l ON l.id = a.levelId
                WHERE category = 'public_ecr'  AND dzongkhagId = '".$id."'
                GROUP BY a.category");
               
            }
        }
       

      //  dd($response_data);
        return $this->successResponse($response_data);
    }

    public function loadInactiveOrgList($dzo_id){
        $response_data=OrganizationDetails::where('status','0')->orwhere('status','Closed')
            ->where('dzongkhagId',$dzo_id)
            ->select( 'id','name','levelId','dzongkhagId')->get();
        return $response_data;
    }

    public function loadProjection($classid){
        $response_data=Projection::where('organizationId',explode('__',$classid)[1])->where('class',explode('__',$classid)[0])
            ->select( 'id','ProjectionNo','academicYear')->first();
        return $response_data;
    }

    public function loadOrgDetails($type="", $id=""){
        $response_data="";
        if($type=="Orgbyid" || $type=="user_logedin_dzo_id"){
            $response_data=OrganizationDetails::where('id',$id)->first();
            if($response_data!=null && $response_data->levelId!=null && $response_data->levelId!=""){
                $level=Level::where('id',$response_data->levelId)->first();
                // $response_data->level=$level;
                $response_data->name=$response_data->name.' '.$level->name;
            }
            if($response_data!=null && $response_data!=""){
                $data = DB::table('classes as c')
                ->join('organization_class_streams as cl', 'c.id', '=', 'cl.classId')
                ->select('cl.*', 'c.class','c.displayOrder', 'c.id AS classId')
                ->where('cl.organizationId',$response_data->id)
                    ->orderBy('c.displayOrder', 'asc')
                ->get();
                $response_data->classes=$data;
                if($response_data->category=="private_school"){
                    $response_data->proprietor=OrganizationProprietorDetails::where('organizationId',$id)->first();
                }
                else{
                    $feed_det=OrganizationFeedingDetails::where('organizationId',$id)->get();
                    if($feed_det!= NULL && $feed_det !=""){
                        $response_data->meals=$feed_det;
                    }
                }
            }
        }
        if($type=="fullOrgDetbyid" || $type=="full_user_logedin_dzo_id"){
            $response_data=OrganizationDetails::where('id',$id)->first();
            if($response_data==null && $response_data==""){
                //Org is Head Quarter and have to check with HQ details
                $response_data=HeadQuaterDetails::where('id',$id)->first();
                $contact = ContactDetails::where('organizationId',$id)->first();
                $response_data->contactDetails=$contact;
                return $this->successResponse($response_data);
            }
            // $response_data->classes=OrganizationClassStream::where('organizationId',$response_data->id)->get();
            $response_data->classes=DB::table('classes as c')
            ->join('organization_class_streams as cl', 'c.id', '=', 'cl.classId')
            ->select('cl.*', 'c.class', 'c.id AS classId')
            ->where('cl.organizationId',$response_data->id)
            ->orderBy('c.displayOrder', 'asc')
            ->get();
            if($response_data->category=="private_school"){
                $response_data->proprioter=OrganizationProprietorDetails::where('organizationId',$response_data->id)->first();
            }
            $loc=Locations::where('organizationId',$response_data->id)->first();
            if($loc!=null && $loc!=""){
                $response_data->locationDetials=$loc;
            }
            $contact = ContactDetails::where('organizationId',$response_data->id)->first();
            if($contact!=null && $contact!=""){
                $response_data->contactDetails=$contact;
            }
        }
        if($type=="Headquarterbyid"){
            $response_data=HeadQuaterDetails::where('id',$id)->select('id','agencyName AS name','dzongkhagId')->first();
        }
        return $this->successResponse($response_data);
    }

    public function loadHeaquarterList($type="", $id=""){
        $response_data="";
        if($type=="all_ministry_departments"){
            $response_data=DepartmentModel::where('type',$id)->get();
        }
        if($type=="user_dzongkhag"){
            $response_data=DepartmentModel::where('dzo_id',$id)->get();
        }

        if($type=="all_division"){
            $response_data=HeadQuaterDetails::where('departmentId',$id)->select('id','agencyName AS name','dzongkhagId')->get();
        }
        if($type=="allList"){
            $response_data=HeadQuaterDetails::select('id','agencyName AS name','dzongkhagId','organizationType')->all();
        }
        return $this->successResponse($response_data);
    }

    public function loadClassStreamSection($type="", $id=""){
        if($type=='school'){
            $response_data = DB::table('organization_class_streams')
            ->join('classes', 'organization_class_streams.classId', '=', 'classes.id')
            ->select('organization_class_streams.*', 'classes.class AS class', 'classes.displayOrder')
            ->where('organizationId', $id)
            ->orderBy('classes.displayOrder', 'asc')
            ->groupBy('organization_class_streams.classId')
            ->get();
            return $this->successResponse($response_data);
        }
        else{
            $section = DB::select('SELECT t1.id AS OrgClassStreamId, t1.organizationId AS org_id, t1.classId AS org_class_id, t1.streamId AS org_stream_id,
            t4.id AS org_section_id, t2.class, t3.stream, t4.section FROM organization_class_streams t1
            JOIN classes t2 ON t1.classId = t2.id LEFT JOIN streams t3 ON t1.streamId = t3.id
            LEFT JOIN section_details t4 ON t1.id = t4.classSectionId WHERE t1.organizationId  = ?', [$id]);
            return $section;
        }

    }
    //added by Tshewang to get organizaiton ids for projection and indicator
    public function loadClassStreamSectionIds($organizationType="",$category="",$dzoId=""){
        if($organizationType=='ECCD'){
            $response_data = DB::table('organization_class_streams AS c')
            ->join('organization_details AS o', 'o.id', '=', 'c.organizationId')
            ->select('c.id')
            ->wherein('o.category',['private_eccd','public_eccd']);
            if($dzoId!="ALL"){
                $response_data=$response_data->where('o.dzongkhagId',$dzoId);
            }
            if($category!="ALL"){
                if($category=="Public"){
                    $response_data=$response_data->where('o.category','public_eccd');
                }
                if($category=="Private"){
                    $response_data=$response_data->where('o.category','private_eccd');
                }
                //need to do for other category
            }
            $response_data=$response_data->get();
            return $this->successResponse($response_data);
        }

    }

    public function getOrgProfile($id=""){
        //dd($id);
        $response_data =OrgProfile::where('org_id',$id)->first();
        if($response_data!=""){
            $org_det=OrganizationDetails::where('id',$response_data->org_id)->first();
            $response_data->orgName=$org_det->name;
            $response_data->level=Level::where('id',$org_det->levelId)->first()->name;
        }
        //dd($response_data);
        return $this->successResponse($response_data);
    }

    public function getClassByType($type=""){
        return Classes::where('status',1)->where('category',$type)->orderBy('displayOrder', 'asc')->get();
    }

    /**
     * Get the Class Streams by Organization
     */

    public function getOrgClassStream($org_id){
        $response_data = DB::table('organization_class_streams')
                    ->join('classes', 'organization_class_streams.classId', '=', 'classes.id')
                    ->select('organization_class_streams.*', 'classes.class AS class', 'classes.displayOrder')
                    ->where('organizationId', $org_id)
                    ->orderBy('classes.displayOrder', 'asc')
                    ->groupBy('organization_class_streams.classId') //added by Tshewang as required only class
                    ->get();

        return $this->successResponse($response_data);
    }

     /**
     * Get the Class Streams by org_class_strema_id
     */

    public function getOrgClassStreambyId($id){

        $response_data = DB::table('organization_class_streams')
                    ->join('classes', 'organization_class_streams.classId', '=', 'classes.id')
                    ->select('organization_class_streams.*', 'classes.class AS class', 'classes.displayOrder')
                    ->where('organization_class_streams.id', $id)
                    ->first();

        return $this->successResponse($response_data);
    }

    public function getSectionById($id){
        $response_data = DB::table('section_details')
            ->select('section AS section', 'id AS section_id')
            ->where('id', $id)
            ->first();
        return $this->successResponse($response_data);
    }

    public function loadStreamList($id){

        $response_data = DB::table('organization_class_streams')
                    ->join('classes', 'organization_class_streams.classId', '=', 'classes.id')
                    ->select('organization_class_streams.*', 'classes.class AS class')
                    ->where('organizationId', $id)
                    ->where('streamId', '<>', 'NULL')
                    ->get();

        return $this->successResponse($response_data);
         // $cls_id="";
        // $org_id="";
        // if(strpos('__',$id)!==false){
        //     $cls_id=explode('__', $id)[0];
        //     $org_id=explode('__', $id)[1];
        //     $response_data = DB::table('organization_class_streams')
        //         ->join('classes', 'organization_class_streams.classId', '=', 'classes.id')
        //         ->select('organization_class_streams.*', 'classes.class AS class')
        //         ->where('organizationId', $org_id)
        //         ->where('classes.id', $cls_id)
        //         ->where('streamId', '<>', 'NULL')
        //         ->get();
        // }
        // else{
        //     $response_data = DB::table('organization_class_streams')
        //             ->join('classes', 'organization_class_streams.classId', '=', 'classes.id')
        //             ->select('organization_class_streams.*', 'classes.class AS class')
        //             ->where('organizationId', $id)
        //             ->where('streamId', '<>', 'NULL')
        //             ->get();
        // }
    }

    public function loadSectionList($id){

        $response_data = DB::table('section_details')
                    ->join('organization_class_streams', 'section_details.classSectionId', '=', 'organization_class_streams.id')
                    ->select('organization_class_streams.*', 'section_details.section AS section', 'section_details.id AS section_id')
                    ->where('organization_class_streams.id', $id)
                    ->get();

        return $this->successResponse($response_data);
    }

    /**
     * the get Arrays fetches the list of classes, streams and sections in an array
     * this is for display the name of the class, stream and section
     */

    public function getClassArray($org_id){
        $response_data = DB::table('organization_class_streams')
                    ->join('classes', 'organization_class_streams.classId', '=', 'classes.id')
                    ->select('organization_class_streams.id AS id', 'classes.class AS class')
                    ->where('organization_class_streams.organizationId', $org_id)
                    ->get();

        return $this->successResponse($response_data);
    }

    public function getStreamArray($org_id){
        $response_data = DB::table('organization_class_streams')
                    ->join('streams', 'organization_class_streams.streamId', '=', 'streams.id')
                    ->select('organization_class_streams.id AS id', 'streams.stream AS stream')
                    ->where('organization_class_streams.organizationId', $org_id)
                    ->get();

        return $this->successResponse($response_data);
    }

    // /**
    //  * the get Arrays fetches the list of classes, streams and sections in an array
    //  * this is for display the name of the class, stream and section
    //  */

    // public function getClassArray($org_id){
    //     $response_data = DB::table('organization_class_streams')
    //                 ->join('classes', 'organization_class_streams.classId', '=', 'classes.id')
    //                 ->select('organization_class_streams.id AS id', 'classes.class AS class')
    //                 ->where('organization_class_streams.organizationId', $org_id)
    //                 ->get();

    //     return $this->successResponse($response_data);
    // }

    // public function getStreamArray($org_id){
    //     $response_data = DB::table('organization_class_streams')
    //                 ->join('streams', 'organization_class_streams.streamId', '=', 'streams.id')
    //                 ->select('organization_class_streams.id AS id', 'streams.stream AS stream')
    //                 ->where('organization_class_streams.organizationId', $org_id)
    //                 ->get();

    //     return $this->successResponse($response_data);
    // }

    public function getSectionArray($org_id){
        $response_data = DB::table('section_details')
                    ->join('organization_class_streams', 'section_details.classSectionId', '=', 'organization_class_streams.id')
                    ->select('section_details.id AS id', 'section_details.section AS section')
                    ->where('organization_class_streams.organizationId', $org_id)
                    ->get();

        return $this->successResponse($response_data);
    }
}
