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
$route['default_controller'] = 'front/home';
$route['index'] = 'front/home';
$route['home'] = 'front/home';
$route['login'] = 'front/home/login';
$route['template_event_list'] = 'front/home/template_event_list';
$route['template_book_event'] = 'front/home/template_book_event';
$route['get_event'] = 'front/home/get_event';
$route['get_eventcategory'] = 'front/home/get_eventcategory';
$route['get_stands'] = 'front/home/get_eventstands';
$route['get_stands_detail'] = 'front/home/get_stands_detail';
$route['reserve_stand'] = 'front/stand';
$route['put_reserve_stand'] = 'front/stand/reserve';
$route['company_login'] = 'front/home/doLogin';
$route['company_register'] = 'front/home/doRegister';
$route['company_logout'] = 'front/home/doLogout';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
