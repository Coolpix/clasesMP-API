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

$router->get('/', function () use ($router) {
    return 'Jummmmm...';
});

$router->group(['prefix' => 'zones'], function () use ($router) {
    $router->get('/', 'ZonesController@getAll');
    $router->get('/{id}', 'ZonesController@getById');
    $router->get('/{id}/groups', 'ZonesController@getGroupsOfZone');
    $router->post('/', 'ZonesController@saveZone');
    $router->put('/{id}', 'ZonesController@updateZone');
    $router->delete('/{id}', 'ZonesController@deleteZone');
});

$router->group(['prefix' => 'groups'], function () use ($router) {
    $router->get('/', 'GroupsController@getAll');
    $router->get('/{id}', 'GroupsController@getById');
    $router->get('/{id}/zone', 'GroupsController@getZoneOfGroup');
    $router->get('/{id}/lessons', 'GroupsController@getLessonsOfGroup');
    $router->get('/{id}/students', 'GroupsController@getStudentsOfGroup');
    $router->post('/', 'GroupsController@saveGroup');
    $router->put('/{id}', 'GroupsController@updateGroup');
    $router->delete('/{id}', 'GroupsController@deleteGroup');
});

$router->group(['prefix' => 'students'], function () use ($router) {
    $router->get('/', 'StudentsController@getAll');
    $router->get('/{id}', 'StudentsController@getById');
    $router->get('/{id}/groups', 'StudentsController@getGroups');
    $router->get('/{id}/lessons', 'StudentsController@getLessons');
    $router->post('/', 'StudentsController@saveStudent');
    $router->put('/{id}', 'StudentsController@updateStudent');
    $router->delete('/{id}', 'StudentsController@deleteStudent');
});

$router->group(['prefix' => 'lessons'], function () use ($router) {
    $router->get('/', 'LessonsController@getAll');
    $router->get('/{id}', 'LessonsController@getById');
    $router->get('/{id}/group', 'LessonsController@getGroupOfLesson');
    $router->get('/{id}/students', 'LessonsController@getStudentsOfLesson');
    $router->post('/', 'LessonsController@saveLesson');
    $router->put('/{id}', 'LessonsController@updateLesson');
    $router->delete('/{id}', 'LessonsController@deleteLesson');
});