<?php
namespace App\Http\Repository;
use App\Http\Repository\AdministrationRepo;
use App\Models\InstructorModel;

class AdministrationRepoImpl implements AdministrationRepo{
    public function module_management($param){
        return 'This is the response sending from the repo';
    }
}