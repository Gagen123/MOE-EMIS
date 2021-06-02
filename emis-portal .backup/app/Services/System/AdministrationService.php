<?php
namespace App\Services\System;

use App\Traits\ServiceHelper;

class AdministrationService{
    use ServiceHelper;
    public $baseUri;
    public $secret;
    public function __construct(){
        $this->baseUri = config('services.user.base_uri');
    }

    public function listData($endpoint, $data = [], $headers = []){
        return $this->performRequest('GET', $endpoint, $data, $headers);
    }

    public function postData($endpoint, $data = [], $headers = []){

        return $this->performRequest('POST', $endpoint, $data, $headers);
    }

}