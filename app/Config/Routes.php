<?php

namespace Config;
$routes = Services::routes();

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();

/* Configuracion de rutas */

$routes->get('/', 'Home::index');
$routes->get('principal', 'Home::index');
$routes->get('quienes_somos', 'Home::quienes_somos');
$routes->get('acerca_de', 'Home::acerca_de');
$routes->get('registro', 'Home::registro');
$routes->get('login', 'Home::login');

/*rutas del registro del usuario*/
$routes->get('/registro', 'usuario_controller::create');
$routes->post('enviar-form', 'usuario_controller::formValidation');

/*rutas del registro del login*/
$routes->get('/login', 'Login_controller');
$routes->post('/enviarlogin', 'Login_controller::auth');
$routes->get('/panel', 'Panel_controller::index',['filter'=> 'auth']);
$routes->get('/logout', 'Login_controller::logout');

if (is_file(APPPATH. 'config/' . ENVIRONMENT . '/Routes.php')){
    require APPPATH . 'config/' . ENVIRONMENT . '/Routes.php';
}
