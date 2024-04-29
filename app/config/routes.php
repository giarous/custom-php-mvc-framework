<?php
/**
 * routes.php
 * 
 * This file defines the routes for the application using the Router.
 */

// Home page
$router->get('', 'PagesController@home');

// About page
$router->get('about', 'PagesController@about');

// Users routes
$router->get('users', 'UsersController@index');
$router->post('users/create', 'UsersController@create');
$router->get('users/edit/{id}', 'UsersController@editForm');
$router->post('users/update/{id}', 'UsersController@update');
$router->post('users/delete/{id}', 'UsersController@delete');

return $router;
