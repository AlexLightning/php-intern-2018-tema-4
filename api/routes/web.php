<?php

$router->get('/festivals', 'FestivalsController@showAllFestivals');
$router->get('/festivals/{id}', 'FestivalsController@updateShow');
$router->post('/festivals', 'FestivalsController@create');
$router->put('/festivals/{id}', 'FestivalsController@update');
$router->delete('/festivals/{id}', 'FestivalsController@delete');

$router->get('/organizers', 'OrganizersController@showAllOrganizers');
$router->get('/organizers/{id}', 'OrganizersController@updateShow');
$router->post('/organizers', 'OrganizersController@create');
$router->put('/organizers/{id}', 'OrganizersController@update');
$router->delete('/organizers/{id}', 'OrganizersController@delete');