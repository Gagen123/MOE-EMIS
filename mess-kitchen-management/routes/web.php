<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});
$router->group(['prefix' => 'api'], function () use ($router) {
    $router->group(['prefix' => 'messManage/'], function () use ($router) {
        
        $router->group(['prefix' => 'foodrelease'], function () use ($router) {
            $router->get('/loadFoodReleaseList', 'messManage\FoodReleaseController@loadFoodReleaseList');
            $router->post('/saveFoodRelease', 'messManage\FoodReleaseController@saveFoodRelease');
            $router->get('/getFoodReleaseItem/{foodreleaseId}', 'messManage\FoodReleaseController@getFoodReleaseItem');
            
        });

        $router->group(['prefix' => 'localprocure'], function () use ($router) {
            $router->get('/loadLocalProcure', 'messManage\LocalProcureController@loadLocalProcure');
            $router->post('/saveLocalProcure', 'messManage\LocalProcureController@saveLocalProcure');
        });
 
        $router->group(['prefix' => 'stockissue'], function () use ($router) {
            $router->get('/loadStockIssuedList', 'messManage\StockIssuedController@loadStockIssuedList');
            $router->post('/saveStockIssued', 'messManage\StockIssuedController@saveStockIssued');
        });


        $router->group(['prefix' => 'stockreceived'], function () use ($router) {
            $router->get('/loadFoodReleaseListing/{org_Id}', 'messManagement\FoodReceivedController@loadFoodReleaseListing');
            $router->post('/saveStockReceived', 'messManage\StockReceivedController@saveStockReceived');
             // $router->get('/getfoodreleaseditemList/{foodreleaseId}', 'messManage\StockReceivedController@getfoodreleaseditemList');
         //     $router->get('/loadStockReceivedList', 'messManage\StockReceivedController@loadStockReceivedList');
           // $router->get('/saveStockReceived', 'messManage\StockReceiveController@saveStockReceived')
        });
        // $router->group(['prefix' => 'foodreleased'], function () use ($router) {
        //    $router->post('/saveFoodRelease', 'messManagement\FoodReleasedController@saveFoodRelease');
        // });
    });
});
    
   