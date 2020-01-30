<?php

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

// Auth
$router->post('/login', 'AuthController@login');
$router->post('/register', 'UserController@register');

$router->group(['middleware' => 'auth'], 
    function() use ($router) {
        $router->get('/', function () use ($router) {
            return date('H:i:s');
        });

        // BRANCH CONTROLLER
        $router->get('/get/all/branch', 'BranchController@getBrachName');
        $router->post('/add/branch', 'BranchController@addBranch');
        $router->put('/update/branch', 'BranchController@updateBranch');
        $router->delete('/delete/branch/{id}', 'BranchController@deleteOneBranch');

        // TREATMENT CONTROLLER
        $router->get('/get/all/treatment', 'TreatmentController@getTreatment');
        $router->get('/get/all/treatment/history/{id}', 'TreatmentController@getTreatmentHistory');
        $router->get('/get/treatment/history/detail/{id}', 'TreatmentController@getSelectedTreatmentHistory');
        $router->get('/get/selected/treatment/{id}', 'TreatmentController@getSelectedTreatment');
        $router->get('/get/all/treatment/list', 'TreatmentController@getTreatmentList');
        $router->post('/add/treatment', 'TreatmentController@addTreatment');
        $router->post('/add/treatment/price', 'TreatmentController@addTreatmentPrice');
        $router->post('/add/treatment/history', 'TreatmentController@addTreatmentHistory');
        $router->put('/update/treatment', 'TreatmentController@updateTreatment');
        $router->delete('/delete/treatment/{id}', 'TreatmentController@deleteOneTreatment');

        // ABSENT CONTROLLER
        $router->get('/get/all/absent/history/{id}', 'AbsentController@getAbsentHistory');
        $router->get('/get/history/detail/{id}', 'AbsentController@getSelectedAbsentHistory');
        $router->get('/get/absent/history/detail/{id}', 'AbsentController@getSelectedAbsentHistory');
        $router->post('/add/absent', 'AbsentController@addAbsent');

        // USER CONTROLLER
        $router->get('/get/all/user', 'UserController@getAllUser');
        $router->get('/get/select/user/{id}', 'UserController@getSelectUser');
        $router->put('/update/user', 'UserController@updateOneUser');
        $router->delete('/delete/user/{id}', 'UserController@deleteOneUser');

        // ADMIN CONTROLLER
        $router->get('/get/admin/treatment/{id}', 'AdminTreatmentController@getTreatmentUser');
        $router->get('/get/admin/treatment/detail/{id}', 'AdminTreatmentController@getTreatmentUserDetail');
        $router->get('/get/admin/absent/{id}', 'AdminAbsentController@getAbsentUser');
        $router->get('/get/admin/absent/detail/{id}', 'AdminAbsentController@getAbsentUserDetail');
        $router->put('/absent/confirm/{id}', 'AdminAbsentController@putAbsentUserConfirm');
    }
);