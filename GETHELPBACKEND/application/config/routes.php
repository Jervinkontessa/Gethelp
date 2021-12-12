<?php
defined('BASEPATH') or exit('No direct script access allowed');


$route['api/auth/login'] = 'api/auth/login';
$route['api/auth/register'] = 'api/auth/register';

//auth
$route['userlogout'] = 'auth/userlogout';
$route['auth'] = 'auth/index';
// controller home
$route['about'] = 'home/about';
$route['terms'] = 'home/terms';
$route['kebijakan-privasi'] = 'home/privasi';
$route['verifikasi-akun'] = 'usersprofile/verifikasi';
$route['verifikasi-akun-individu'] = 'usersprofile/verifikasi_individu';
$route['verifikasi-akun-organisasi'] = 'usersprofile/verifikasi_organisasi';
$route['kontak'] = 'home/kontak';

//controller galang dana
$route['panduan-galang-dana'] = 'galangdana';
$route['form-galang-dana'] = 'galangdana/mulai';

//userprofile
$route['user'] = 'usersprofile/index';

//snap
$route['donate/(:any)'] = 'vtweb/index/$1';
$route['thankspage'] = 'vtweb/finish';

//controller campaign
$route['campaign'] = 'campaign/index';
$route['campaign/all'] = 'campaign/hapus_session';
$route['campaign/report/(:any)'] = 'campaign/report/$1';
$route['campaign/(:num)'] = 'campaign/index/$1';
$route['campaign/(:any)'] = 'campaign/detail/$1';


$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
