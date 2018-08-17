<?php

$router->get('/festivals', 'FestivalsController@showAllFestivals');
$router->post('/festivals', 'FestivalsController@create');
$router->put('/festivals/{id}', 'FestivalsController@update');
$router->delete('/festivals/{id}', 'FestivalsController@delete');