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
            $router->get('/loadLocalProcure/{orgId}', 'messManage\LocalProcureController@loadLocalProcure');
            $router->post('/saveLocalProcure', 'messManage\LocalProcureController@saveLocalProcure');
            $router->get('/localProcureEditList/{locId}', 'messManage\LocalProcureController@localProcureEditList');
        });
 
        $router->group(['prefix' => 'stockissue'], function () use ($router) {
            $router->get('/loadStockIssuedList/{org_Id}', 'messManage\StockIssuedController@loadStockIssuedList');
            $router->post('/saveStockIssued', 'messManage\StockIssuedController@saveStockIssued');
        });


        $router->group(['prefix' => 'stockreceived'], function () use ($router) {
            $router->get('/loadFoodReleaseListing/{org_Id}', 'messManage\StockReceivedController@loadFoodReleaseListing');
            $router->post('/saveStockReceived', 'messManage\StockReceivedController@saveStockReceived');
            $router->get('/getStockReceivedDetails/{stockreceivedId}', ['uses' => 'messManage\StockReceiveController@getStockReceivedDetails']);
            //just added 
            $router->get('/getStockReceivedDetails/{stockreceivedId}', 'messManage\StockReceiveController@getStockReceivedDetails');
          
            $router->get('/viewitemreceived/{item}', 'messManage\StockReceivedController@viewitemreceived');
        });
        $router->get('/getInventoryList/{org_Id}', 'messManage\StockInventoryController@getInventoryList');
      
    });
   
});
    
   