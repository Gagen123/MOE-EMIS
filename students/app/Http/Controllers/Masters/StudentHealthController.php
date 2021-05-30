<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Masters\StudentHealth;
use App\Models\Masters\HealthScreening;
use App\Models\Masters\Term;
use App\Traits\ApiResponser;

class StudentHealthController extends Controller
{
    //
    use ApiResponser;

    public function __construct()
    {
        //
    }
     /**
     * method to list health type
    */

    public function loadStudentHealth(){
        $studenthealth = StudentHealth::all();
        return $studenthealth;
    }
     /** 
     * method to save or update health type
    */

    public function saveStudentHealth(Request $request){
        //return($request['studenthealthName']);
        $id = $request->id;
        if( $id != null){
            $dis = [
                'name'          => $request['studenthealthName'],
                'status'        => $request['status'],
            ];
            $studenthealth = StudentHealth::where('id', $id)->update($dis);
            return $this->successResponse($studenthealth, Response::HTTP_CREATED);
        }else{

            $dis = [
                'name'          => $request['studenthealthName'],
                'status'        => $request['status'],
            ];

            $studenthealth = StudentHealth::create($dis);
            return $this->successResponse($studenthealth, Response::HTTP_CREATED);
        }
    }

//Screening 
    public function loadScreening(){
        $screening = HealthScreening::all();
        return $screening;
    }
     /** 
     * method to save or update health type
    */

    public function saveScreening(Request $request){
        //return($request['screeningName']);
        $id = $request->id;
        if( $id != null){
            $src = [
                'name'          => $request['screeningName'],
                'status'        => $request['status'],
            ];
            $screening = HealthScreening::where('id', $id)->update($src);
            return $this->successResponse($screening, Response::HTTP_CREATED);
        }else{

            $src = [
                'name'          => $request['screeningName'],
                'status'        => $request['status'],
            ];

            $screening = HealthScreening::create($src);
            return $this->successResponse($screening, Response::HTTP_CREATED);
        }
    }
    // Student_health_term_controller
    public function loadTerm(){
        $term = Term::all();
        return $term;
        // return $this->successResponse($location);
    }

    /** 
     * method to save or update term type
    */
    public function saveTerm(Request $request){

        $id = $request->id;
        if( $id != null){
            $dis = [
                'name'          => $request['termName'],
                'status'        => $request['status'],
            ];
            $term = Term::where('id', $id)->update($dis);
            return $this->successResponse($term, Response::HTTP_CREATED);
        }else{
            $dis = [
                'name'          => $request['termName'],
                'status'        => $request['status'],
            ];

            $term = Term::create($dis);
            return $this->successResponse($term, Response::HTTP_CREATED);
        }
    }
}
