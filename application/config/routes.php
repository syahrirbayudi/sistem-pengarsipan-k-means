<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "halaman_depan";
$route['404_override'] = '';
$route['auth']    = 'halaman_depan/auth';
$route['petunjuk'] =  'halaman_depan/petunjuk';
$route['tentang'] = 'halaman_depan/tentang';

$route['administrasi/dashboard']    = 'administrasi';
$route['administrasi/logout']    = 'administrasi/logout';


$route['administrasi/data_bus']    = 'administrasi/data_bus_view';
$route['administrasi/data_bus/add'] = 'administrasi/data_bus_add';
$route['administrasi/data_bus/save'] = 'administrasi/data_bus_save';
$route['administrasi/data_bus/edit/(:num)'] = 'administrasi/data_bus_edit/$1';
$route['administrasi/data_bus/del/(:num)'] = 'administrasi/data_bus_del/$1';

$route['administrasi/data_tujuan']    = 'administrasi/data_tujuan_view';
$route['administrasi/data_tujuan/add'] = 'administrasi/data_tujuan_add';
$route['administrasi/data_tujuan/save'] = 'administrasi/data_tujuan_save';
$route['administrasi/data_tujuan/edit/(:num)'] = 'administrasi/data_tujuan_edit/$1';
$route['administrasi/data_tujuan/del/(:num)'] = 'administrasi/data_tujuan_del/$1';

$route['administrasi/data_loket']    = 'administrasi/data_loket_view';
$route['administrasi/data_loket/add'] = 'administrasi/data_loket_add';
$route['administrasi/data_loket/save'] = 'administrasi/data_loket_save';
$route['administrasi/data_loket/edit/(:num)'] = 'administrasi/data_loket_edit/$1';
$route['administrasi/data_loket/del/(:num)'] = 'administrasi/data_loket_del/$1';

$route['administrasi/data_tahun']    = 'administrasi/data_tahun_view';
$route['administrasi/data_tahun/add'] = 'administrasi/data_tahun_add';
$route['administrasi/data_tahun/save'] = 'administrasi/data_tahun_save';
$route['administrasi/data_tahun/edit/(:num)'] = 'administrasi/data_tahun_edit/$1';
$route['administrasi/data_tahun/del/(:num)'] = 'administrasi/data_tahun_del/$1';

$route['administrasi/data_fasilitas']    = 'administrasi/data_fasilitas_view';
$route['administrasi/data_fasilitas/add'] = 'administrasi/data_fasilitas_add';
$route['administrasi/data_fasilitas/save'] = 'administrasi/data_fasilitas_save';
$route['administrasi/data_fasilitas/edit/(:num)'] = 'administrasi/data_fasilitas_edit/$1';
$route['administrasi/data_fasilitas/del/(:num)'] = 'administrasi/data_fasilitas_del/$1';

$route['administrasi/data_jumlah_tujuan_loket']    = 'administrasi/data_jumlah_tujuan_loket_view';
$route['administrasi/data_jumlah_tujuan_loket/add'] = 'administrasi/data_jumlah_tujuan_loket_add';
$route['administrasi/data_jumlah_tujuan_loket/save'] = 'administrasi/data_jumlah_tujuan_loket_save';
$route['administrasi/data_jumlah_tujuan_loket/edit/(:num)'] = 'administrasi/data_jumlah_tujuan_loket_edit/$1';
$route['administrasi/data_jumlah_tujuan_loket/del/(:num)'] = 'administrasi/data_jumlah_tujuan_loket_del/$1';

$route['administrasi/data_jumlah_fasilitas_loket']    = 'administrasi/data_jumlah_fasilitas_loket_view';
$route['administrasi/data_jumlah_fasilitas_loket/add'] = 'administrasi/data_jumlah_fasilitas_loket_add';
$route['administrasi/data_jumlah_fasilitas_loket/save'] = 'administrasi/data_jumlah_fasilitas_loket_save';
$route['administrasi/data_jumlah_fasilitas_loket/edit/(:num)'] = 'administrasi/data_jumlah_fasilitas_loket_edit/$1';
$route['administrasi/data_jumlah_fasilitas_loket/del/(:num)'] = 'administrasi/data_jumlah_fasilitas_loket_del/$1';

$route['administrasi/data_jumlah_bus_loket']    = 'administrasi/data_jumlah_bus_loket_view';
$route['administrasi/data_jumlah_bus_loket/add'] = 'administrasi/data_jumlah_bus_loket_add';
$route['administrasi/data_jumlah_bus_loket/save'] = 'administrasi/data_jumlah_bus_loket_save';
$route['administrasi/data_jumlah_bus_loket/edit/(:num)'] = 'administrasi/data_jumlah_bus_loket_edit/$1';
$route['administrasi/data_jumlah_bus_loket/del/(:num)'] = 'administrasi/data_jumlah_bus_loket_del/$1';


$route['pimpinan/dashboard']    = 'pimpinan';
$route['pimpinan/logout']    = 'pimpinan/logout';

$route['pimpinan/cetak_bus']    = 'pimpinan/cetak_bus';
$route['pimpinan/cetak_bus/view']    = 'pimpinan/cetak_bus_view';
$route['pimpinan/cetak_loket']    = 'pimpinan/cetak_loket';
$route['pimpinan/cetak_loket/view']    = 'pimpinan/cetak_loket_view';
$route['pimpinan/cetak_tujuan']    = 'pimpinan/cetak_tujuan';
$route['pimpinan/cetak_tujuan/view']    = 'pimpinan/cetak_tujuan_view';
$route['pimpinan/cetak_tujuan_tahun']    = 'pimpinan/cetak_tujuan_tahun';
$route['pimpinan/cetak_tujuan_tahun/view/(:num)']    = 'pimpinan/cetak_tujuan_tahun/$1';

$route['supplier/dashboard']    = 'supplier';
$route['supplier/generate_awal']    = 'supplier/generate_awal';
$route['supplier/generate_rata']    = 'supplier/generate_rata';
$route['supplier/generate_centroid']    = 'supplier/generate_centroid';
$route['supplier/iterasi_kmeans']    = 'supplier/iterasi_kmeans';
$route['supplier/iterasi_kmeans_lanjut']    = 'supplier/iterasi_kmeans_lanjut';
$route['supplier/iterasi_kmeans_hasil']    = 'supplier/iterasi_kmeans_hasil';

$route['supplier/logout']    = 'supplier/logout';


/* End of file routes.php */
/* Location: ./application/config/routes.php */