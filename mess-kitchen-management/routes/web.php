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
            $router->get('/getFoodReleaseDetails/{foodrelId}', 'messManage\FoodReleaseController@getFoodReleaseDetails');
            $router->get('/ViewFoodReleaseDetials/{foodreleaseId}', 'messManage\FoodReleaseController@ViewFoodReleaseDetials');
        //    $router->get('/getFoodReleaseItem/{foodreleaseId}', 'messManage\FoodReleaseController@getFoodReleaseItem');
            $router->delete('/deleteFile/{id}', ['uses' => 'messManage\FoodReleaseController@deleteFile']);

        });

        $router->group(['prefix' => 'localprocure'], function () use ($router) {
            $router->get('/loadLocalProcure/{orgId}', 'messManage\LocalProcureController@loadLocalProcure');
            $router->post('/saveLocalProcure', 'messManage\LocalProcureController@saveLocalProcure');
            $router->get('/localProcureEditList/{locId}', 'messManage\LocalProcureController@localProcureEditList');
        });

        $router->group(['prefix' => 'stockissue'], function () use ($router) {
            $router->get('/loadStockIssuedList/{orgId}', 'messManage\StockIssuedController@loadStockIssuedList');
            $router->post('/saveStockIssued', 'messManage\StockIssuedController@saveStockIssued');
            $router->get('/StockIssueEditList/{lssId}', 'messManage\StockIssuedController@StockIssueEditList');
            $router->get('/getquantity/{itemId}/{chekva}/{orgId}', 'messManage\StockIssuedController@getquantity');
        });


        $router->group(['prefix' => 'stockreceived'], function () use ($router) {
            $router->get('/loadFoodReleaseListing/{orgId}', 'messManage\StockReceiveController@loadFoodReleaseListing');
            $router->post('/saveStockReceived', 'messManage\StockReceiveController@saveStockReceived');
            $router->get('/viewitemreceived/{stockreceivedId}', 'messManage\StockReceiveController@viewitemreceived');
            $router->get('/loadStockReceiveView/{StockReceivedID}', ['uses' => 'messManage\StockReceiveController@loadStockReceiveView']);

           $router->get('/getStockReceivedDetails/{stkId}', 'messManage\StockReceiveController@getStockReceivedDetails');
            //just added

        });

        $router->get('/getInventoryList/{orgId}', 'messManage\StockInventoryController@getInventoryList');

    });

    $router->group(['prefix' => 'dietary'], function () use ($router) {
        $router->post('/savediatery', 'DietaryController@savediatery');
        $router->get('/getdiatery/{org_Id}', 'DietaryController@getdiatery');
        $router->get('/getdiateryDetails/{id}', 'DietaryController@getdiateryDetails');
        $router->get('/checkdata/{date}/{org_id}', 'DietaryController@checkdata');

        $router->post('/approvereject', ['uses' => 'DietaryController@approvereject']);
    });


});

