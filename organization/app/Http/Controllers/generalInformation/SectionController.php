<?php

namespace App\Http\Controllers\generalInformation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use App\Models\generalInformation\Section;
use App\Models\generalInformation\SectionDetails;
use Illuminate\Support\Facades\DB;

class SectionController extends Controller
{
    use ApiResponser;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /** 
     * method to save section
    */
    public function saveSection(Request $request){
        $id = $request->id;
        if($id != null){
            DB::table('section_details')->where('classSectionId', $request['class_stream_id'])->delete();

            foreach ($request->input('users') as $i => $user){
                $section_details = array(
                'classSectionId'    =>  $request['class_stream_id'],
                'section'           =>  $user['section'],
            );

                // $sec = SectionDetails::create($section_details);
                $sec = SectionDetails::create($section_details);

            }
            return $this->successResponse($sec, Response::HTTP_CREATED);

        }else{
            foreach ($request->input('users') as $i => $user){
                $section_details = array(
                'classSectionId'    =>  $request['class_stream_id'],
                'section'           =>  $user['section'],
            );
                $sec = SectionDetails::create($section_details);
            }
            return $this->successResponse($sec, Response::HTTP_CREATED);
        }
        
    }

    /**
     * method to get class by organization Id
     */
    public function getClassByOrganizationId($orgId){
        $class = DB::table('organization_class_streams as a')
            ->join('classes as b', 'b.id', '=', 'a.classId')
            ->select('a.id as record_id','a.classId as id', 'b.class as class')->where('organizationId', $orgId)->groupby('a.classId')->get();
        return $class;
    }

    /**
     * method to get stream by class Id
     */
    public function getStreamByClassId($classId){
        $stream = DB::table('organization_class_streams as a')
            ->join('streams as b', 'b.id', '=', 'a.streamId')
            ->select('a.id as record_id','a.streamId as id', 'b.stream as stream')->where('a.classId', $classId)->get();
        return $stream;
    }

    /**
     * method to get existing section by class Id
     */
    public function getExistingSectionByClass($classId){
        $section = DB::table('section_details as a')
            ->join('organization_class_streams as b', 'b.id', '=', 'a.classSectionId')
            ->select('a.id','a.section')
            ->where('a.classSectionId', $classId)->get();
        return $section;
    }
	// public function getclassSections($orgId){
    //     dd($orgId);
    //     $section = DB::select('SELECT t1.organizationId AS org_id, t1.classId AS org_class_id, t1.streamId AS org_stream_id,t4.id AS org_section_id, t2.class, t3.stream, t4.section FROM organization_class_streams t1 JOIN classes t2 ON t1.classId = t2.id LEFT JOIN streams t3 ON t1.streamId = t3.id LEFT JOIN section_details t4 ON t1.id = t4.classSectionId WHERE t1.organizationId  = ?', [$orgId]);
    //     return $section;
    // }

}
