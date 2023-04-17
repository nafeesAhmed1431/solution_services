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
|	https://codeigniter.com/userguide3/general/routing.html
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
$route['default_controller']    = 'Auth';
$route['Dashboard']             = 'Admin/index';    

// project routes
$route['AddProject']            = 'Project/new_project';
$route['Project']              = 'Project/all_projects';
$route['Completed']             = 'Project/completed_projects';
$route['Archived']              = 'Project/archived_projects';
$route['Pending']               = 'Project/pending_projects';
$route['Details/(:num)']        = 'Project/project_details/$1';
$route['ProjectDetails/(:num)'] = 'Project/project_details/$1';
$route['EditProject/(:num)']    = 'Project/edit_project/$1';
$route['UpdateProject']         = 'Project/update_project';
$route['AllProjects']           = 'Project/complete_projects';
$route['Process']               = 'Admin/process';
$route['Lists']                 = 'Admin/lists';

//User Routes
$route['Users']              = 'Admin/users';
$route['AddUsers']           = 'Admin/new_user';
$route['EditUser/(:num)']    = 'Admin/edit_user/$1';
$route['UpdateUser']         = 'Admin/update_user';

//List Routes
$route['EditUser/(:num)']    = 'Admin/edit_user/$1';
$route['UpdateUser']         = 'Admin/update_user';

// Front Routes
$route['State']                 = 'Front/project_info';
$route['State/(:num)']          = 'Front/project_info/$1';


// Prrofile routes
$route['MyProfile']             = 'Admin/my_info';
$route['UpdateMember']          = 'Member/edit_profile';
$route['changePassword']        = 'Auth/change_password';

// mail
$route['settings']        = 'Admin/settings';

$route['SendProjectEmail/(:num)']      = 'Auth/new_project_email/$1';

// base routes
$route['404_override']          = '';
$route['translate_uri_dashes']  = FALSE;
