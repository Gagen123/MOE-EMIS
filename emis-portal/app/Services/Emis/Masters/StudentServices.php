<?php

namespace App\Services\Emis\Masters;

use App\Traits\ServiceHelper;

class StudentServices
{
    use ServiceHelper;
    public $baseUri;
    public $secret;
    // public $service_code = "/admin_api/v1";

    public function __construct(){
        $this->baseUri = config('emisconfig.studentservice.base_uri');
    }

    public function listData($endpoint, $data = null){
        if ($data == null) {
            return $this->performRequest('GET', $endpoint);
        }
        return $this->performRequest('GET', $endpoint, $data);
    }

    public function createData($endpoint, $data) {
        return $this->performRequest('POST', $endpoint, $data);
    }

    public function viewData($endpoint, $id)
    {
        return $this->performRequest('GET',  "$endpoint/{$id}");
    }

    public function editData($endpoint, $data, $id)
    {
        return $this->performRequest('PUT', "$endpoint/{$id}", $data);
    }

    public function deleteData($endpoint, $id)
    {
        return $this->performRequest('DELETE', "$endpoint/{$id}");
    }

    public function getListData($endpoint, $id = null)
    {
        $uri = $id == null ? "$endpoint" : "$endpoint/{$id}";
        return $this->performRequest('GET', $uri);
    }
}