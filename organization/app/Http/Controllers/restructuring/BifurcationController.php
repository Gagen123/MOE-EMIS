<?php

namespace App\Http\Controllers\restructuring;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponser;
use App\Models\OrganizationDetails;


class BifurcationController extends Controller
{
    use ApiResponser;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
    }

    /**
     * method to save bifurcation details
     */
    public function saveBifurcation(Request $request){
            $bir = [
                'new1Name'                     =>  $request['name'],
                'new1Level'                    =>  $request['level'],
                'new1Category'                 =>  $request['category'],
                'new1Dzongkhag'                =>  $request['dzongkhag'],
                'new1Gewog'                    =>  $request['gewog'],
                'new1Chiwog'                   =>  $request['chiwog'],
                'new1Location'                 =>  $request['location'],
                'new1IsGeoLocated'             =>  $request['geoLocated'],
                'new1IsSenSchool'              =>  $request['senSchool'],
                'new1ParentSchool'             =>  $request['parentSchool'],
                'new1IsCoLocated'              =>  $request['coLocated'],
                'new2Name'                     =>  $request['name1'],
                'new2Level'                    =>  $request['level1'],
                'new2Category'                 =>  $request['category1'],
                'new2Dzongkhag'                =>  $request['dzongkhag1'],
                'new2Gewog'                    =>  $request['gewog1'],
                'new2Chiwog'                   =>  $request['chiwog1'],
                'new2Location'                 =>  $request['location1'],
                'new2IsGeoLocated'             =>  $request['geoLocated1'],
                'new2IsSenSchool'              =>  $request['senSchool1'],
                'new2ParentSchool'             =>  $request['parentSchool1'],
                'new2IsCoLocated'              =>  $request['coLocated1'],
            ];
            $bifurcation = Bifurcation::create($bir);
        return $this->successResponse($bifurcation, Response::HTTP_CREATED);
    }

    /**
     * method to load organization details
     */
    public function loadBifurcation(){
        $orgDetails = OrganizationDetails::all();
        return $orgDetails;
    }
}
