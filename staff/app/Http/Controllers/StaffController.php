<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
class StaffController extends Controller{
    public function __construct(){
    }
    public function index(Request $request){
        $current_timestamp = Carbon::now()->timestamp; 
        return $current_timestamp;
    }
}
