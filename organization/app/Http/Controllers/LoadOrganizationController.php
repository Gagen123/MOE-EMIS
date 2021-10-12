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
use App\Models\generalInformation\OrganizationCompoundDetail;
use App\Models\generalInformation\ConnectivityModel;
use App\Models\Masters\Location;
use Exception;

class LoadOrganizationController extends Controller{
    use ApiResponser;
    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
    }

    //GET ORGANIZATION DETAILS BY DZO ID AND LEVEL ID USED IN REPORT
    public function getOrgByDzoLevel($dzoId,$levelId){
        $response_data = DB::table('organization_details')
                ->select('id', 'name')
                ->where('dzongkhagId',$dzoId)
                ->where('levelId',$levelId)
                ->where('status',1)
                ->get();
        return $response_data;
    }

    public function loadOrgList($type="", $id=""){
        $response_data="";
        if($type=="userworkingagency"){
            $response_data=OrganizationDetails::where('id',$id)->wherein('category',['public_school','public_eccd','public_ecr'])
            ->where('status','1')
            ->select( 'id','name','levelId','dzongkhagId','gewogId','category','code')->get();
        }
        if($type=="all_eccds_dzogkhag_wise"){
            $response_data=OrganizationDetails::where('dzongkhagId',$id)->where('category','like','%eccd%')->get();
        }
        if($type=="public_eccd"){
            $response_data=OrganizationDetails::where('dzongkhagId',$id)->wherein('category',['public_eccd','private_eccd'])->get();
        }
        if($type=="school" || $type=="ce"){
            if($id!=null && $id!="" && $id!="NA"){
                $response_data=OrganizationDetails::where('dzongkhagId',$id)->wherein('category',['public_school','private_school'])->get();
            }
            else{
                $response_data=OrganizationDetails::wherein('category',['public_school','private_school'])->get();
            }
        }
        if($type=="ECR"){
            $response_data=OrganizationDetails::where('dzongkhagId',$id)->where('category','public_ecr')->get();
        }
        if($type=="gewoggwise"){
            $response_data=OrganizationDetails::where('gewogId',$id)->wherein('category',['public_school','public_eccd','public_ecr'])->select( 'id','name','levelId','dzongkhagId')->get();
        }
        if($type=="dzongkhagwise" || $type=="userdzongkhagwise"){
            $response_data=OrganizationDetails::where('dzongkhagId',$id)->wherein('category',['public_school','public_eccd','coorporate_eccd','ngo_eccd','public_ecr','private_school','private_eccd'])->get();
        }

        if($type=="allorganizationList"){
            if($id=="allData"){
                $response_data=OrganizationDetails::all();
            }
            else{        // dd($request);
                $response_data=OrganizationDetails::select( 'id','name','levelId','dzongkhagId','category','code')->get();
            }
        }
        if(strpos($type,'admission_dzongkhagwise')!==false){
            $category=explode('__',$type)[1];
            //If ECCD or PP, load all relevant schools
            //Else load schools that do not have projections as zero
            if($category=="ECCD"){
                $response_data=OrganizationDetails::wherein('category',['private_eccd','public_eccd'])->where('dzongkhagId',$id)->get();
            }else if ($category == "PP"){
                $response_data=OrganizationDetails::wherein('category',['private_school','public_school'])->where('dzongkhagId',$id)->get();
            } else{
                $class_name = $category;
                $response_data = DB::table('organization_details')
                    ->join('organization_projections','organization_projections.organizationId', '=', 'organization_details.id')
                    ->join('organization_class_streams','organization_class_streams.id', '=', 'organization_projections.class')
                    ->join('classes','classes.id', '=', 'organization_class_streams.classId')
                    ->select('organization_details.id AS id','organization_details.name AS name', 'classes.class AS class')
                    ->whereIn('organization_details.category',['private_school','public_school'])
                    ->where('organization_projections.ProjectionNo','>', '0')
                    ->where('organization_details.dzongkhagId','=', $id)
                    ->where('classes.class','LIKE', $class_name)
                    ->get();
                return $this->successResponse($response_data);
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
             COUNT(CASE WHEN category = 'private_eccd' THEN 1 END) AS Private_ECCD,
             COUNT(CASE WHEN category = 'NGO_eccd' THEN 1 END) AS NGO_ECCD,
             COUNT(CASE WHEN category = 'Corporate_eccd' THEN 1 END) AS Corporate_ECCD
             FROM organization_details");
            }else{
              //  $response_data=OrganizationDetails::wherein('category',['private_eccd','public_eccd'])->where('dzongkhagId',$id)->get();
              $response_data = DB::select(" SELECT
              COUNT(CASE WHEN category = 'public_eccd' THEN 1 END) AS Public_ECCD,
              COUNT(CASE WHEN category = 'private_eccd' THEN 1 END) AS Private_ECCD,
              COUNT(CASE WHEN category = 'NGO_eccd' THEN 1 END) AS NGO_ECCD,
              COUNT(CASE WHEN category = 'Corporate_eccd' THEN 1 END) AS Corporate_ECCD
              FROM organization_details
              WHERE dzongkhagId = '".$id."'");
            }
        }
        //to get both private and public School
        if($type=="School"){
            if($id=="ALL"){
                // $response_data = DB::select(" SELECT a.category,
                // COUNT(CASE WHEN l.name LIKE 'Primary%' THEN 1 END) AS Primary_School,
                // COUNT(CASE WHEN l.name LIKE 'Lower Secondary%' THEN 2 END) AS Lower_Secondary_School,
                // COUNT(CASE WHEN l.name LIKE 'Middle Secondary%' THEN 3 END) AS Middle_secondary_school,
                // COUNT(CASE WHEN l.name LIKE 'Higher Secondary%' THEN 4 END) AS Higher_Secondary_School,
                // SUM(CASE WHEN a.category = 'private_school' OR a.category = 'public_school' THEN 1
                //     ELSE 0 END) AS Total
                // FROM `organization_details` a
                // LEFT JOIN `level` l ON l.id = a.levelId
                // WHERE category = 'public_school' OR category = 'private_school'
                // GROUP BY a.category;");

                //The following is the transpose of the above query
                $response_data = DB::select(" SELECT l.name,
                        COUNT(CASE WHEN a.category LIKE 'public_school' THEN 1 END) AS Public_School,
                        COUNT(CASE WHEN a.category LIKE 'private_school' THEN 2 END) AS Private_School,
                        SUM(CASE WHEN a.category = 'private_school' OR a.category = 'public_school' THEN 1
                            ELSE 0 END) AS Total
                        FROM `organization_details` a
                        LEFT JOIN `level` l ON l.id = a.levelId
                        WHERE category = 'public_school' OR category = 'private_school'
                        GROUP BY l.name;");


            } else {
                // $response_data = DB::select("SELECT a.category,
                // COUNT(CASE WHEN l.name LIKE 'Primary%' THEN 1 END) AS Primary_School,
                // COUNT(CASE WHEN l.name LIKE 'Lower Secondary%' THEN 2 END) AS Lower_Secondary_School,
                // COUNT(CASE WHEN l.name LIKE 'Middle Secondary%' THEN 3 END) AS Middle_secondary_school,
                // COUNT(CASE WHEN l.name LIKE 'Higher Secondary%' THEN 4 END) AS Higher_Secondary_School,
                // SUM(CASE WHEN a.category = 'private_school' OR a.category = 'public_school' THEN 1
                //     ELSE 0 END) AS Total
                // FROM `organization_details` a
                // LEFT JOIN `level` l ON l.id = a.levelId
                // WHERE (category = 'public_school' OR category = 'private_school') AND dzongkhagId = '".$id."'
                // GROUP BY a.category");

                //The following is the transpose of the above query
                $response_data = DB::select(" SELECT l.name,
                        COUNT(CASE WHEN a.category LIKE 'public_school' THEN 1 END) AS Public_School,
                        COUNT(CASE WHEN a.category LIKE 'private_school' THEN 2 END) AS Private_School,
                        SUM(CASE WHEN a.category = 'private_school' OR a.category = 'public_school' THEN 1
                            ELSE 0 END) AS Total
                        FROM `organization_details` a
                        LEFT JOIN `level` l ON l.id = a.levelId
                        WHERE (category = 'public_school' OR category = 'private_school') AND dzongkhagId = '".$id."'
                        GROUP BY l.name;");

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
                GROUP BY a.category;");

            }
        }
        if($type=="ALL"){
            if($id=="ALL"){
                $response_data = DB::select("SELECT  c.class AS Class, c.displayOrder,
                COUNT(class) AS No_of_Section
                FROM `organization_class_streams` a
                LEFT JOIN classes c ON c.id=a.classId
                LEFT JOIN `organization_details` o ON o.id=a.organizationId
                WHERE c.class NOT LIKE '%Age%'
                GROUP BY classId
                ORDER BY c.displayOrder;");
            } else {
                $response_data = DB::select("SELECT  c.class AS Class, c.displayOrder,
                COUNT(class) AS No_of_Section
                FROM `organization_class_streams` a
                LEFT JOIN classes c ON c.id=a.classId
                LEFT JOIN `organization_details` o ON o.id=a.organizationId
                WHERE c.class NOT LIKE '%Age%' AND dzongkhagId = '".$id."'
                GROUP BY classId
                ORDER BY c.displayOrder;");

            }
        }


      //  dd($response_data);
        return $this->successResponse($response_data);
    }

    //added by saru
    public function loadClassSize($type="", $id=""){
        $response_data="";
        if($type=="ALL"){
            if($id=="ALL"){
                $response_data = DB::select("SELECT  c.class AS Class, c.displayOrder,
                COUNT(class) AS No_of_Section
                FROM `organization_class_streams` a
                LEFT JOIN classes c ON c.id=a.classId
                LEFT JOIN `organization_details` o ON o.id=a.organizationId
                WHERE c.class NOT LIKE '%Age%'
                GROUP BY classId
                ORDER BY c.displayOrder;");
            } else {
                $response_data = DB::select("SELECT  c.class AS Class, c.displayOrder,
                COUNT(class) AS No_of_Section
                FROM `organization_class_streams` a
                LEFT JOIN classes c ON c.id=a.classId
                LEFT JOIN `organization_details` o ON o.id=a.organizationId
                WHERE c.class NOT LIKE '%Age%' AND dzongkhagId = '".$id."'
                GROUP BY classId
                ORDER BY c.displayOrder;");

            }
        }
        if($type=="MSS"){
            if($id=="ALL"){
                $response_data = DB::select("SELECT  c.class AS Class, c.displayOrder,
                COUNT(class) AS No_of_Section
                FROM `organization_class_streams` a
                LEFT JOIN classes c ON c.id=a.classId
                LEFT JOIN `organization_details` o ON o.id=a.organizationId
                left join `level` l on l.id=o.levelId
                WHERE c.class NOT LIKE '%Age%'
                And l.name= 'Middle Secondary School'
                GROUP BY classId
                ORDER BY c.displayOrder;");
            } else {
                $response_data = DB::select("SELECT  c.class AS Class, c.displayOrder,
                COUNT(class) AS No_of_Section
                FROM `organization_class_streams` a
                LEFT JOIN classes c ON c.id=a.classId
                LEFT JOIN `organization_details` o ON o.id=a.organizationId
                left join `level` l on l.id=o.levelId
                WHERE c.class NOT LIKE '%Age%'
                And l.name= 'Middle Secondary School' And dzongkhagId = '".$id."'
                GROUP BY classId
                ORDER BY c.displayOrder;");

            }
        }
        if($type=="HSS"){
            if($id=="ALL"){
                $response_data = DB::select("SELECT  c.class AS Class, c.displayOrder,
                COUNT(class) AS No_of_Section
                FROM `organization_class_streams` a
                LEFT JOIN classes c ON c.id=a.classId
                LEFT JOIN `organization_details` o ON o.id=a.organizationId
                left join `level` l on l.id=o.levelId
                WHERE c.class NOT LIKE '%Age%'
                And l.name= 'Higher Secondary School'
                GROUP BY classId
                ORDER BY c.displayOrder;");
            } else {
                $response_data = DB::select("SELECT c.class AS Class, c.displayOrder,
                COUNT(class) AS No_of_Section
                FROM `organization_class_streams` a
                LEFT JOIN classes c ON c.id=a.classId
                LEFT JOIN `organization_details` o ON o.id=a.organizationId
                left join `level` l on l.id=o.levelId
                WHERE c.class NOT LIKE '%Age%'
                And l.name= 'Higher Secondary School' And dzongkhagId = '".$id."'
                GROUP BY classId
                ORDER BY c.displayOrder;");

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
            if($response_data!=null ){
                $response_data->dzongkhagId=$response_data->dzongkhagId;
                $response_data->name=$response_data->name;
                if($response_data->levelId!=null && $response_data->levelId!="" && $response_data->levelId!="ECCD" && $response_data->levelId!="ECR"){
                    $level=Level::where('id',$response_data->levelId)->first();
                    // $response_data->level=$level;
                    if($level!=null && $level!=""){
                        $response_data->name=$response_data->name.' '.$level->name;
                    }
                }
            }
            if($response_data!=null && $response_data->parentSchoolId!=null && $response_data->parentSchoolId!="" && $response_data->parentSchoolId!="0"){
                $parent=OrganizationDetails::where('id',$response_data->parentSchoolId)->first();
                if($parent!=null && $parent!=""){
                    $response_data->parentSchoolName=$parent->name;
                }
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

                $loc=Location::where('id',$response_data->locationId)->first();
                // dd($response_data->locationId,$response_data);
                if($loc!=null && $loc!=""){
                    $response_data->location_type_name=$loc->name;
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
            $loc=Location::where('id',$response_data->locationId)->first();
            if($loc!=null && $loc!=""){
                $response_data->name=$loc->name;
            }
            //for transactional location details
            $loc_det=Locations::where('organizationId',$response_data->id)->first();
            if($loc_det!=null && $loc_det!=""){
                $response_data->loc_details=$loc_det;
            }

            $contact = ContactDetails::where('organizationId',$response_data->id)->first();
            if($contact!=null && $contact!=""){
                $response_data->contactDetails=$contact;
            }
            $compound = OrganizationCompoundDetail::where('organizationId',$response_data->id)->first();
            if($compound!=null && $compound!=""){
                $response_data->compoundDetails=$compound;
            }
            $connectivity = ConnectivityModel::where('organizationId',$response_data->id)->first();
            if($connectivity!=null && $connectivity!=""){
                $response_data->connectivityDetails=$connectivity;
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

        if($type=="dzongkhag_department"){
            $response_data=DepartmentModel::where('dzo_id',$id)->where('type','dzongkhag')->get();
        }

        if($type=="details_by_id"){
            $response_data=HeadQuaterDetails::where('id',$id)->first();
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
            JOIN classes t2 ON t1.classId = t2.id
            LEFT JOIN streams t3 ON t1.streamId = t3.id
            LEFT JOIN section_details t4 ON t1.id = t4.classSectionId
            WHERE t1.organizationId  = ?', [$id]);
            return $section;
        }

    }
    //added by Tshewang to get organizaiton ids for projection and indicator
    public function loadClassStreamSectionIds($organizationType="",$category="",$dzoId=""){
        if($organizationType=='ECCD'){
            $response_data = DB::table('organization_class_streams AS c')
            ->join('organization_details AS o', 'o.id', '=', 'c.organizationId')
            ->select('c.id')
            ->wherein('o.category',['private_eccd','public_eccd','ngo_eccd','coorporate_eccd']);
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
                if($category=="NGO"){
                    $response_data=$response_data->where('o.category','ngo_eccd');
                }
                if($category=="Coorporate"){
                    $response_data=$response_data->where('o.category','coorporate_eccd');
                }
                //need to do for other category
            }
            $response_data=$response_data->get();
            return $this->successResponse($response_data);
        }
        if($organizationType=='School'){
            $response_data = DB::table('organization_class_streams AS c')
            ->join('organization_details AS o', 'o.id', '=', 'c.organizationId')
            ->join('level AS l', 'l.id', '=', 'o.levelId')
            ->select('c.id');
            // ->wherein('o.category',['private_eccd','public_eccd','ngo_eccd','coorporate_eccd']);
            if($dzoId!="ALL"){
                $response_data=$response_data->where('o.dzongkhagId',$dzoId);
            }
            if($category!="ALL"){
                if($category=="Public"){
                    $response_data=$response_data->where('o.category','public_school');
                }
                if($category=="Public_HSS"){
                    $response_data=$response_data->where('o.category','public_school')
                    ->where('o.category','public_school')
                    ->where('l.name','like','Higher%');
                }
                if($category=="Public_MSS"){
                    $response_data=$response_data->where('o.category','public_school')
                    ->where('o.category','public_school')
                    ->where('l.name','like','Middle%');
                }
                if($category=="Public_LSS"){
                    $response_data=$response_data->where('o.category','public_school')
                    ->where('o.category','public_school')
                    ->where('l.name','like','Lower%');
                }
                if($category=="Private"){
                    $response_data=$response_data->where('o.category','private_school');
                }
                if($category=="Private_HSS"){
                    $response_data=$response_data->where('o.category','private_school')
                    ->where('o.category','private_school')
                    ->where('l.name','like','Higher%');
                }
                if($category=="Private_MSS"){
                    $response_data=$response_data->where('o.category','private_school')
                    ->where('o.category','private_school')
                    ->where('l.name','like','Middle%');
                }
                if($category=="Private_LSS"){
                    $response_data=$response_data->where('o.category','private_school')
                    ->where('o.category','private_school')
                    ->where('l.name','like','Lower%');
                }
                //need to do for other category
            }
            $response_data=$response_data->get();
            return $this->successResponse($response_data);
        }

    }

    // public function getOrgProfile($id=""){
    //     $response_data =OrgProfile::where('org_id',$id)->first();
    //     if($response_data!=null && $response_data!=""){
    //         $org_det=OrganizationDetails::where('id',$response_data->org_id)->first();
    //         $orgName=$org_det->name;
    //         if($org_det->levelId!=null && $org_det->levelId!=""){
    //             $level=Level::where('id',$org_det->levelId)->first();
    //             if($level!=null && $level!=""){
    //                 $orgName=$orgName.' '.$level->name;
    //             }
    //         }
    //         $response_data->orgName=$orgName;
    //     }
    //     return $this->successResponse($response_data);
    // }
    public function getOrgProfile($id="", $type=""){
        $response_data =OrgProfile::where('org_id',$id)->first();
        if($response_data!=null && $response_data!=""){
            if($type=="Ministry" || "Dzongkhag"){
                $org_det=HeadQuaterDetails::where('id',$id)->first();
                if($org_det!=null && $org_det!=""){
                    $response_data->orgName=$org_det->agencyName;
                }
             }
             if($type=="Org"){
                $org_det=OrganizationDetails::where('id',$id)->first();
                $orgName=$org_det->name;
                if($org_det!=null && $org_det->levelId!=null && $org_det->levelId!="" && $org_det->levelId!="ECCD" && $org_det->levelId!="ECR"){
                    $level=Level::where('id',$org_det->levelId)->first();
                    if($level!=null && $level!=""){
                        $orgName=$orgName.' '.$level->name;
                    }
                }
                $response_data->orgName=$orgName;
            }
        }

        return $this->successResponse($response_data);
    }

    public function getClassByType($type=""){
        return Classes::where('status',1)->where('category',$type)->orderBy('displayOrder', 'asc')->get();
    }

    /**
     * Get a particular class given OrgClassStreamId
     * param is the OrgClassStreamId
     */

    public function getClassById($id=""){
        $response_data = DB::table('organization_class_streams')
            ->join('classes', 'organization_class_streams.classId', '=', 'classes.id')
            ->select('organization_class_streams.id', 'classes.class AS class')
            ->where('organization_class_streams.id', $id)
            ->first();
        return $this->successResponse($response_data);
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
     * Get the Class Streams by org_class_stream_id
     */

    public function getOrgClassStreambyId($id){

        $response_data = DB::table('organization_class_streams')
            ->join('classes', 'organization_class_streams.classId', '=', 'classes.id')
            ->select('organization_class_streams.*', 'classes.class AS class', 'classes.displayOrder')
            ->where('organization_class_streams.id', $id)
            ->first();

        return $this->successResponse($response_data);
    }

     /**
     * Get the Class Streams by Org Id and Class (e.g.PP)
     */

    public function getOrgClassStreamByOrg($org_id, $class_name){
        $response_data = DB::table('organization_class_streams')
            ->join('classes', 'organization_class_streams.classId', '=', 'classes.id')
            ->select('organization_class_streams.id')
            ->where('organization_class_streams.organizationId', $org_id)
            ->where('classes.class', 'LIKE', $class_name)
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

    /**
     * Function to load the feeder schools by Org Id
     * Used in Admissions
     */

    public function loadParentSchoolList($orgId){

        $response_data = DB::table('organization_feeder')
                    ->join('organization_details', 'organization_details.id', '=', 'organization_feeder.parentschool')
                    ->select('organization_details.id AS id', 'organization_details.name AS name')
                    ->where('organization_feeder.feederschool', $orgId)
                    ->get();

        return $this->successResponse($response_data);
    }

    /**
     * Get the student school details based on OrgClassId
     */

    public function getStudentSchoolDetails($OrgClassId = ""){
        $response_data = DB::table('organization_class_streams')
                    ->join('organization_details', 'organization_details.id', '=', 'organization_class_streams.organizationId')
                    ->join('classes', 'classes.id', '=', 'organization_class_streams.classId')
                    ->select('organization_details.id AS id', 'organization_details.name AS name', 'organization_details.dzongkhagId AS dzongkhagId',
                                    'classes.class AS class')
                    ->where('organization_class_streams.id', $OrgClassId)
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

     // method by Chimi Thinley
    public function getOrgWiseClassesForSpms(Request $request){
        $response_data = DB::table('organization_class_streams')
            ->select('organizationId AS org_id','classId AS org_class_id')
            ->whereIn('organizationId',$request['org_id'])
            ->whereIn('classId',explode(",",$request['org_class_id']))->get();
        return $response_data;
    }
    public function getDzoWiseNoOfSchools(){
        $response_data = DB::select("SELECT t1.dzongkhagId,COUNT(t1.id) AS no_of_schools FROM organization_details t1 JOIN level t2 ON t1.levelId = t2.id GROUP BY t1.dzongkhagId");
        return $response_data;
    }

    //method by gagen for pulling orgClassStreamId For academic purpose
    public function LoadStdIdAwardResponsibilites($class_id){
        $response_data = DB::table('organization_class_streams')
            ->select('id AS orgClassStreamId')
            ->where('classId',$class_id)->get();
        return $response_data;
    }

    //this function is to pull registered organization from bifurcation by gagen
    public function loadRegisteredList($type){
        if($type=="bifurcation"){
            $data=DB::table('application_details AS t1')
            ->join('application_est_bifurcation AS t2', 't1.id', '=', 't2.ApplicationDetailsId')
            ->select('t2.id as id','t1.application_no AS applicationNo','t2.proposedName1 AS bifuractionOrg', 't2.proposedName AS parentOrg','t2.organizationId AS parentOrgId')
            ->where('t1.status','=','Registered')
            ->get();
        }
        else if($type=="merge"){
            $data=DB::table('application_details AS t1')
            ->join('application_est_merger AS t2', 't1.id', '=', 't2.ApplicationDetailsId')
            ->select('t2.id as id','t1.application_no AS applicationNo','t2.OrgType AS OrgType', 't2.proposedName AS NewproposedName','t2.OldOrganizationId AS OldOrganizationId','t2.OldOrganizationId2 AS OldOrganizationId2')
            ->where('t1.status','=','Registered')
            ->get();

        }
        return $data;
    }
    public function loadParentOrgDetailOfRegistered($type="",$id=""){
        if($type=="bifurcation"){
            $data=DB::table('application_est_bifurcation AS a')
            ->select('a.organizationId AS orgId')
            ->where('a.id','=',$id)
            ->get();
        }
        else if($type=="merge"){
            $data=DB::table('application_est_merger AS a')
            ->select('a.OldOrganizationId AS orgId')
            ->where('a.id','=',$id)
            ->get();

        } 
        return $data;
    }

}
