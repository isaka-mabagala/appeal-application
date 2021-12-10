<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['login'] = 'admin/login';
$route['dashboard/(:any)'] = 'admin/index/$1';
$route['dashboard'] = 'admin';
$route['default_controller'] = 'appeal';
$route['(:any)'] = 'appeal/index/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
