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
$route['default_controller'] = 'Home_Controller';
$route['home'] = "Home_Controller";
$route['handle_ajax_request'] = 'Ajax_Controller';

$route['admin'] = "Admin_Controller";
$route['admin/(:any)'] = "Admin_Controller/$1";
$route['admin/(:any)/(:any)'] = "Admin_Controller/$1/$2";
$route['admin/(:any)/(:any)/(:any)'] = "Admin_Controller/$1/$2/$3";

$route['franchisee'] = "Franchisee_Controller";
$route['franchisee/(:any)'] = "Franchisee_Controller/$1";
$route['franchisee/(:any)/(:any)'] = "Franchisee_Controller/$1/$2";
$route['franchisee/(:any)/(:any)/(:any)'] = "Franchisee_Controller/$1/$2/$3";

$route['inventory'] = "Inventory_Controller";
$route['inventory/(:any)'] = "Inventory_Controller/$1";
$route['inventory/(:any)/(:any)'] = "Inventory_Controller/$1/$2";
$route['inventory/(:any)/(:any)/(:any)'] = "Inventory_Controller/$1/$2/$3";

$route['stock_management'] = "StockMgt_Controller";
$route['stock_management/(:any)'] = "StockMgt_Controller/$1";
$route['stock_management/(:any)/(:any)'] = "StockMgt_Controller/$1/$2";
$route['stock_management/(:any)/(:any)/(:any)'] = "StockMgt_Controller/$1/$2/$3";


$route['reporting'] = "Reporting_Controller";
$route['reporting/(:any)'] = "Reporting_Controller/$1";
$route['reporting/(:any)/(:any)'] = "Reporting_Controller/$1/$2";
$route['reporting/(:any)/(:any)/(:any)'] = "Reporting_Controller/$1/$2/$3";


$route['404_override'] = 'Error_Controller';
$route['error'] = "Error_Controller";
$route['translate_uri_dashes'] = FALSE;
