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
$route['default_controller'] = 'goadmin';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/*
| -------------------------------------------------------------------------
| Sample REST API Routes
| -------------------------------------------------------------------------
*/
$route['api/example/users/(:num)'] = 'api/example/users/id/$1'; // Example 4
$route['api/example/users/(:num)(\.)([a-zA-Z0-9_-]+)(.*)'] = 'api/example/users/id/$1/format/$3$4'; // Example 8
$route['api/daftar.json'] = 'api/Api_login/daftar';
$route['api/login.json'] = 'api/Api_login/login';
$route['api/aktivasi.json'] = 'api/Api_login/aktivasi';
$route['api/kirim_password.json'] = 'api/Api_login/kirimPassword';

$route['api/promosi.json'] = 'api/Api_beranda/promosi';

$route['api/produk_all.json'] = 'api/Api_info/produk';
$route['api/pertemuan.json'] = 'api/Api_info/pertemuan';
$route['api/flip.json'] = 'api/Api_info/flip';
$route['api/plan.json'] = 'api/Api_info/plan';

$route['api/persentasi.json'] = 'api/Api_youtube/persentasi';
$route['api/basicpack.json'] = 'api/Api_youtube/basicpack';
$route['api/persentasi_standar.json'] = 'api/Api_youtube/persentasistandar';
$route['api/testimoni.json'] = 'api/Api_youtube/testimoni';

$route['api/bank.json'] = 'api/android/bank';
$route['api/sales.json'] = 'api/android/sales';

$route['api/cek_cart.json'] = 'api/Api_transaksi/cekcart';
$route['api/change-kategori.json'] = 'api/Api_transaksi/changekat';
$route['api/change-produk.json'] = 'api/Api_transaksi/changeproduk';
$route['api/cart.json'] = 'api/Api_transaksi/cart';
$route['api/get-consumer.json'] = 'api/Api_transaksi/consumer';
$route['api/orderkeun.json'] = 'api/Api_transaksi/orderkeun';
$route['api/in-form-upload.json'] = 'api/Api_transaksi/getorderbyid';
$route['api/finish.json'] = 'api/Api_transaksi/finish';

$route['api/cartedit.json'] = 'api/android/cartedit';
$route['api/cartdelete.json'] = 'api/android/cartdelete';
$route['api/cartdeleteall.json'] = 'api/android/cartdeleteall';
$route['api/order.json'] = 'api/android/order';

$route['api/cek_pin.json'] = 'api/android/cekpin';
$route['api/list_order_status.json'] = 'api/android/getorder';
$route['api/upload_bukti.json'] = 'api/android/upbukti';
$route['api/bank_admin.json'] = 'api/android/bankadmin';

$route['api/get-provinsi.json'] = 'api/Api_ongkir/provinsi';
$route['api/get-kota.json'] = 'api/Api_ongkir/kota';
$route['api/get-kecamatan.json'] = 'api/Api_ongkir/kecamatan';
$route['api/get-ongkir.json'] = 'api/Api_ongkir/ongkir';

$route['api/get-report.json'] = 'api/Api_report/reporttbl';
$route['api/search-report.json'] = 'api/Api_report/reporttbl2';
$route['api/detail-report.json'] = 'api/Api_report/orderdetail';
$route['api/bonusku.json'] = 'api/Api_report/bonus';