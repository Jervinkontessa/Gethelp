<?php
defined('BASEPATH') or exit('No direct script access allowed');


$route['api/auth/login'] = 'api/auth/login';
$route['api/auth/register'] = 'api/auth/register';

//auth
$route['userlogout'] = 'auth/userlogout';
$route['auth'] = 'auth/index';
// controller home
$route['about'] = 'utama/about';
$route['terms'] = 'utama/terms';
$route['kebijakan-privasi'] = 'utama/privasi';
$route['verifikasi-akun'] = 'usersprofile/verifikasi';
$route['verifikasi-akun-individu'] = 'usersprofile/verifikasi_individu';
$route['verifikasi-akun-organisasi'] = 'usersprofile/verifikasi_organisasi';
$route['kontak'] = 'utama/kontak';
$route['home/kontak'] = 'utama/kontak';
//controller galang dana
$route['panduan-galang-dana'] = 'galangdana';
$route['form-galang-dana'] = 'galangdana/mulai';

//userprofile
$route['user'] = 'usersprofile/index';

//snap
$route['donate/(:any)'] = 'vtweb/index/$1';
$route['thankspage'] = 'vtweb/finish';
$route['notifikasi'] = 'vtweb/notification';

//controller campaign
$route['campaign'] = 'campaign/index';
$route['campaign/all'] = 'campaign/hapus_session';
$route['campaign/report/(:any)'] = 'campaign/report/$1';
$route['campaign/(:num)'] = 'campaign/index/$1';
$route['campaign/(:any)'] = 'campaign/detail/$1';


$route['default_controller'] = 'utama';
$route['404_override'] = 'errorpage/notfound';
$route['translate_uri_dashes'] = FALSE;
