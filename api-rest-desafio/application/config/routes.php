<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

/*Login /Logout */
$route['ApiRest/login']['post']      = 'AutorizaController/login';
$route['ApiRest/logout']['post']     = 'AutorizaController/logout';



/*GET (lista)*/
$route['ApiRest/estados']['get']         = 'ApiRestController/listaEstado';
$route['ApiRest/cidades']['get']         = 'ApiRestController/listaCidade';

/*GET $id(Lista)*/
$route['ApiRest/estados/(:num)']['get']  = 'ApiRestController/detalheEstado/$1';
$route['ApiRest/cidades/(:num)']['get']  = 'ApiRestController/detalheCidade/$1';

/*POST (Insert/Create)*/
$route['ApiRest/estados']['post']   	 = 'ApiRestController/insertEstado';
$route['ApiRest/cidades']['post']   	 = 'ApiRestController/insertCidade';

/*PUT (Update)*/
$route['ApiRest/estados/(:num)']['put']  = 'ApiRestController/updateEstado/$1';
$route['ApiRest/cidades/(:num)']['put']  = 'ApiRestController/updateCidade/$1';

/*DELETE (Delete)*/
$route['ApiRest/estados/(:num)']['delete'] = 'ApiRestController/deleteEstado/$1';
$route['ApiRest/cidades/(:num)']['delete'] = 'ApiRestController/deleteCidade/$1';




$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
