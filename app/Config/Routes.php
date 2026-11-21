<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
$routes->get('escuelas', 'EscuelaController::index');
$routes->post('escuelas/responsable/guardar', 'EscuelaController::guardarResponsable');
$routes->get('escuelas/responsable/estado/(:num)/(:alpha)', 'EscuelaController::cambiarEstadoResponsable/$1/$2');