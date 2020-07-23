<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Administrasi extends CI_Controller
{

	function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('login') != TRUE) {
			$this->load->view('admin/error');
		}

		$this->load->model('adminmodel');
		$this->load->model('model');
	}

	function index()
	{

		$sesinya	= $this->session->userdata('login');
		if ($sesinya['level'] != '1') {

			$this->load->view('admin/error');
		} else {

			$this->load->model('model');
			$data = array(
				'title'			=> '.:: Selamat Datang Bagian Admin::. ',
				'nama'			=> $sesinya['nama'],
				'petunjuk'		=> $this->model->getPetunjuk(),
				'wewenang'		=> $this->model->getWewenang(),
				'titlesistem'	=> $this->model->getTitle(),
			);

			$this->load->view('admin/header', $data);
			$this->load->view('admin/dashboard');
			$this->load->view('admin/footer');
		}
	}

	function data_bus_view()
	{

		$this->load->library('session');
		$sesinya	= $this->session->userdata('login');
		if ($sesinya['level'] != '1') {

			$this->load->view('admin/error');
		} else {

			$data_bus = $this->adminmodel->selectdata('data_bus order by no desc')->result_array();

			$data = array(
				'title'			=> ' Data bus  ',
				'nama'			=> $sesinya['nama'],
				'data_bus'		=> $data_bus,
				'titlesistem'	=> $this->model->getTitle(),
			);

			$this->load->view('admin/header', $data);
			$this->load->view('admin/data_bus');
			$this->load->view('admin/footer');
		}
	}

	function data_bus_add()
	{
		$this->load->library('session');
		$sesinya	= $this->session->userdata('login');
		if ($sesinya['level'] != '1') {

			$this->load->view('admin/error');
		} else {

			$data = array(
				'title'				=> '.:: Tambah Data Bus ::. ',
				'nama'				=> $sesinya['nama'],
				'titlesistem'		=> $this->model->getTitle(),
				'no'				=> '',
				'status'			=> 'baru',
				'merk_bus'			=> '',
				'kelas_bus'			=> '',
				'jumlah_tujuan'			=> '',
				'jumlah_kursi'		=> '',
				'persen_ketersediaan'		=> '',
				'total_sedia'			=> '',

			);

			$this->load->view('admin/header', $data);
			$this->load->view('admin/data_bus_form');
			$this->load->view('admin/footer');
		}
	}

	function data_bus_save()
	{
		if ($_POST) {

			$status 			= $this->input->post('status');
			$no 				= $this->input->post('no');
			$merk_bus				= $this->input->post('merk_bus');
			$kelas_bus	= $this->input->post('kelas_bus');
			$jumlah_tujuan				= $this->input->post('jumlah_tujuan');
			$jumlah_kursi				= $this->input->post('jumlah_kursi');
			$persen_ketersediaan	= $this->input->post('persen_ketersediaan');
			$total_sedia				= $this->input->post('total_sedia');

			if ($status == 'baru') {
				$data = array(
					'merk_bus'	=> $merk_bus,
					'kelas_bus'	=> $kelas_bus,
					'jumlah_tujuan'			=> $jumlah_tujuan,
					'jumlah_kursi'	=> $jumlah_kursi,
					'persen_ketersediaan'	=> $persen_ketersediaan,
					'total_sedia'			=> $total_sedia,
				);
				$sukses = '
					<div class="alert alert-success">
					  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					  <strong>Sukses!</strong> Data anda telah tesimpan.
					</div>
				';
				$this->session->set_flashdata('sukses', $sukses);
				$this->adminmodel->insertdata('data_bus', $data);
				redirect('administrasi/data_bus');
			} else {
				$data = array(
					'merk_bus'	=> $merk_bus,
					'kelas_bus'	=> $kelas_bus,
					'jumlah_tujuan'			=> $jumlah_tujuan,
					'jumlah_kursi'	=> $jumlah_kursi,
					'persen_ketersediaan'	=> $persen_ketersediaan,
					'total_sedia'			=> $total_sedia,
				);
				$sukses = '
					<div class="alert alert-success">
					  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					  <strong>Sukses!</strong> Data anda telah diperbarui.
					</div>
				';
				$this->session->set_flashdata('sukses', $sukses);
				$this->adminmodel->updatedata('data_bus', $data, array('no' => $no));
				redirect('administrasi/data_bus');
			}
		} else {
			$this->load->view('admin/error');
		}
	}


	function data_bus_edit($id = '')
	{
		$this->load->library('session');
		$sesinya	= $this->session->userdata('login');
		if ($sesinya['level'] != '1') {

			$this->load->view('admin/error');
		} else {

			$data_bus = $this->adminmodel->selectdata('data_bus where no = "' . $id . '"')->result_array();

			$data = array(
				'title'				=> '.:: Edit Data bus ::. ',
				'titlesistem'	=> $this->model->getTitle(),
				'nama'				=> $sesinya['nama'],
				'no'				=> $data_bus[0]['no'],
				'status'			=> 'edit',
				'merk_bus'			=> $data_bus[0]['merk_bus'],
				'kelas_bus'			=> $data_bus[0]['kelas_bus'],
				'jumlah_tujuan'			=> $data_bus[0]['jumlah_tujuan'],
				'jumlah_kursi'			=> $data_bus[0]['jumlah_kursi'],
				'persen_ketersediaan'			=> $data_bus[0]['persen_ketersediaan'],
				'total_sedia'			=> $data_bus[0]['total_sedia'],

			);

			$this->load->view('admin/header', $data);
			$this->load->view('admin/data_bus_form');
			$this->load->view('admin/footer');
		}
	}

	function data_bus_del($id = '')
	{
		$hasil	= $this->adminmodel->deldata('data_bus', array('no' => $id));
		$sukses = '
					<div class="alert alert-success">
					  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					  <strong>Sukses!</strong> Data anda berhasil dihapus.
					</div>
				';
		$this->session->set_flashdata('sukses', $sukses);
		redirect('administrasi/data_bus');
	}

	function data_tujuan_view()
	{

		$this->load->library('session');
		$sesinya	= $this->session->userdata('login');
		if ($sesinya['level'] != '1') {

			$this->load->view('admin/error');
		} else {

			$data_tujuan = $this->adminmodel->selectdata('data_tujuan LEFT JOIN data_bus on data_tujuan.no=data_bus.no')->result_array();

			$data = array(
				'title'			=> '.:: Data Tujuan ::. ',
				'nama'			=> $sesinya['nama'],
				'data_tujuan'		=> $data_tujuan,
				'titlesistem'	=> $this->model->getTitle(),
			);

			$this->load->view('admin/header', $data);
			$this->load->view('admin/data_tujuan');
			$this->load->view('admin/footer');
		}
	}

	function data_tujuan_add()
	{
		$this->load->library('session');
		$sesinya	= $this->session->userdata('login');
		if ($sesinya['level'] != '1') {

			$this->load->view('admin/error');
		} else {
			$pilih_bus = $this->adminmodel->selectdata('data_bus order by no desc')->result_array();

			$data = array(
				'title'				=> '.:: Tambah Data Tujuan ::. ',
				'nama'				=> $sesinya['nama'],
				'titlesistem'		=> $this->model->getTitle(),
				'no_tujuan'		=> '',
				'status'			=> 'baru',
				'nama_tujuan'		=> '',
				'no'				=> $pilih_bus,

			);

			$this->load->view('admin/header', $data);
			$this->load->view('admin/data_tujuan_form');
			$this->load->view('admin/footer');
		}
	}

	function data_tujuan_save()
	{
		if ($_POST) {

			$status 			= $this->input->post('status');
			$no_tujuan 				= $this->input->post('no_tujuan');
			$nama_tujuan				= $this->input->post('nama_tujuan');
			$no					= $this->input->post('no');

			if ($status == 'baru') {
				$data = array(
					'nama_tujuan'	=> $nama_tujuan,
					'no'	=> $no,
				);
				$sukses = '
					<div class="alert alert-success">
					  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					  <strong>Sukses!</strong> Data anda telah tesimpan.
					</div>
				';
				$this->session->set_flashdata('sukses', $sukses);
				$this->adminmodel->insertdata('data_tujuan', $data);
				redirect('administrasi/data_tujuan');
			} else {
				$data = array(
					'nama_tujuan'	=> $nama_tujuan,
					'no'	=> $no,
				);
				$sukses = '
					<div class="alert alert-success">
					  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					  <strong>Sukses!</strong> Data anda telah diperbarui.
					</div>
				';
				$this->session->set_flashdata('sukses', $sukses);
				$this->adminmodel->updatedata('data_tujuan', $data, array('no_tujuan' => $no_tujuan));
				redirect('administrasi/data_tujuan');
			}
		} else {
			$this->load->view('admin/error');
		}
	}


	function data_tujuan_edit($id = '')
	{
		$this->load->library('session');
		$sesinya	= $this->session->userdata('login');
		if ($sesinya['level'] != '1') {

			$this->load->view('admin/error');
		} else {

			$data_tujuan = $this->adminmodel->selectdata('data_tujuan where no_tujuan = "' . $id . '"')->result_array();
			$pilih_bus = $this->adminmodel->selectdata('data_bus order by merk_bus desc')->result_array();

			$data = array(
				'title'				=> '.:: Edit Data Tujuan ::. ',
				'titlesistem'	=> $this->model->getTitle(),
				'nama'				=> $sesinya['nama'],
				'no_tujuan'				=> $data_tujuan[0]['no_tujuan'],
				'status'			=> 'edit',
				'nama_tujuan'			=> $data_tujuan[0]['nama_tujuan'],
				'no'			=> $pilih_bus,

			);

			$this->load->view('admin/header', $data);
			$this->load->view('admin/data_tujuan_form');
			$this->load->view('admin/footer');
		}
	}

	function data_tujuan_del($id = '')
	{
		$hasil	= $this->adminmodel->deldata('data_tujuan', array('no_tujuan' => $id));
		$sukses = '
					<div class="alert alert-success">
					  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					  <strong>Sukses!</strong> Data anda berhasil dihapus.
					</div>
				';
		$this->session->set_flashdata('sukses', $sukses);
		redirect('administrasi/data_tujuan');
	}

	function data_loket_view()
	{

		$this->load->library('session');
		$sesinya	= $this->session->userdata('login');
		if ($sesinya['level'] != '1') {

			$this->load->view('admin/error');
		} else {

			$data_loket = $this->adminmodel->selectdata('data_loket order by no_loket desc')->result_array();
			//data_tujuan LEFT JOIN data_bus on data_tujuan.no=data_bus.no
			$data = array(
				'title'			=> '.:: Data Loket ::. ',
				'nama'			=> $sesinya['nama'],
				'data_loket'		=> $data_loket,
				'titlesistem'	=> $this->model->getTitle(),
			);




			$this->load->view('admin/header', $data);
			$this->load->view('admin/data_loket');
			$this->load->view('admin/footer');
		}
	}

	function data_loket_add()
	{
		$this->load->library('session');
		$sesinya	= $this->session->userdata('login');
		if ($sesinya['level'] != '1') {

			$this->load->view('admin/error');
		} else {

			$data = array(
				'title'				=> '.:: Tambah Data Penumpang ::. ',
				'nama'				=> $sesinya['nama'],
				'titlesistem'		=> $this->model->getTitle(),
				'no_loket'		=> '',
				'status'			=> 'baru',
				'nama_loket'		=> '',
				'jumlah_penumpang_total'		=> '',
				'ketersediaan_obat_total'		=> '',
				'jumlah_fasilitas_total'		=> '',

			);

			$this->load->view('admin/header', $data);
			$this->load->view('admin/data_loket_form');
			$this->load->view('admin/footer');
		}
	}

	function data_loket_save()
	{
		if ($_POST) {

			$status 			= $this->input->post('status');
			$no_loket 				= $this->input->post('no_loket');
			$nama_loket			= $this->input->post('nama_loket');


			if ($status == 'baru') {
				$data = array(
					'nama_loket'	=> $nama_loket,

				);
				$sukses = '
					<div class="alert alert-success">
					  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					  <strong>Sukses!</strong> Data anda telah tesimpan.
					</div>
				';
				$this->session->set_flashdata('sukses', $sukses);
				$this->adminmodel->insertdata('data_loket', $data);
				redirect('administrasi/data_loket');
			} else {
				$data = array(
					'nama_loket'	=> $nama_loket,
				);
				$sukses = '
					<div class="alert alert-success">
					  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					  <strong>Sukses!</strong> Data anda telah diperbarui.
					</div>
				';
				$this->session->set_flashdata('sukses', $sukses);
				$this->adminmodel->updatedata('data_loket', $data, array('no_loket' => $no_loket));
				redirect('administrasi/data_loket');
			}
		} else {
			$this->load->view('admin/error');
		}
	}


	function data_loket_edit($id = '')
	{
		$this->load->library('session');
		$sesinya	= $this->session->userdata('login');
		if ($sesinya['level'] != '1') {

			$this->load->view('admin/error');
		} else {

			$data_loket = $this->adminmodel->selectdata('data_loket where no_loket = "' . $id . '"')->result_array();

			$data = array(
				'title'				=> '.:: Edit Data Tujuan ::. ',
				'titlesistem'	=> $this->model->getTitle(),
				'nama'				=> $sesinya['nama'],
				'no_loket'				=> $data_loket[0]['no_loket'],
				'status'			=> 'edit',
				'nama_loket'			=> $data_loket[0]['nama_loket'],
				'jumlah_penumpang_total'			=> $data_loket[0]['jumlah_penumpang_total'],
				'ketersediaan_bus_total'			=> $data_loket[0]['ketersediaan_bus_total'],
				'jumlah_fasilitas_total'			=> $data_loket[0]['jumlah_fasilitas_total'],

			);

			$this->load->view('admin/header', $data);
			$this->load->view('admin/data_loket_form');
			$this->load->view('admin/footer');
		}
	}

	function data_loket_del($id = '')
	{
		$hasil	= $this->adminmodel->deldata('data_loket', array('no_loket' => $id));
		$sukses = '
					<div class="alert alert-success">
					  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					  <strong>Sukses!</strong> Data anda berhasil dihapus.
					</div>
				';
		$this->session->set_flashdata('sukses', $sukses);
		redirect('administrasi/data_loket');
	}


	function data_tahun_view()
	{

		$this->load->library('session');
		$sesinya	= $this->session->userdata('login');
		if ($sesinya['level'] != '1') {

			$this->load->view('admin/error');
		} else {

			$data_tahun = $this->adminmodel->selectdata('data_tahun order by no_tahun desc')->result_array();

			$data = array(
				'title'			=> '.:: Data Tahun ::. ',
				'nama'			=> $sesinya['nama'],
				'data_tahun'		=> $data_tahun,
				'titlesistem'	=> $this->model->getTitle(),
			);

			$this->load->view('admin/header', $data);
			$this->load->view('admin/data_tahun');
			$this->load->view('admin/footer');
		}
	}

	function data_tahun_add()
	{
		$this->load->library('session');
		$sesinya	= $this->session->userdata('login');
		if ($sesinya['level'] != '1') {

			$this->load->view('admin/error');
		} else {

			$data = array(
				'title'				=> '.:: Tambah Data Tahun ::. ',
				'nama'				=> $sesinya['nama'],
				'titlesistem'		=> $this->model->getTitle(),
				'no_tahun'		=> '',
				'status'			=> 'baru',
				'nama_tahun'		=> '',

			);

			$this->load->view('admin/header', $data);
			$this->load->view('admin/data_tahun_form');
			$this->load->view('admin/footer');
		}
	}

	function data_tahun_save()
	{
		if ($_POST) {

			$status 			= $this->input->post('status');
			$no_tahun 				= $this->input->post('no_tahun');
			$nama_tahun				= $this->input->post('nama_tahun');

			if ($status == 'baru') {
				$data = array(
					'nama_tahun'	=> $nama_tahun,
				);
				$sukses = '
					<div class="alert alert-success">
					  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					  <strong>Sukses!</strong> Data anda telah tesimpan.
					</div>
				';
				$this->session->set_flashdata('sukses', $sukses);
				$this->adminmodel->insertdata('data_tahun', $data);
				redirect('administrasi/data_tahun');
			} else {
				$data = array(
					'nama_tahun'	=> $nama_tahun,
				);
				$sukses = '
					<div class="alert alert-success">
					  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					  <strong>Sukses!</strong> Data anda telah diperbarui.
					</div>
				';
				$this->session->set_flashdata('sukses', $sukses);
				$this->adminmodel->updatedata('data_tahun', $data, array('no_tahun' => $no_tahun));
				redirect('administrasi/data_tahun');
			}
		} else {
			$this->load->view('admin/error');
		}
	}


	function data_tahun_edit($id = '')
	{
		$this->load->library('session');
		$sesinya	= $this->session->userdata('login');
		if ($sesinya['level'] != '1') {

			$this->load->view('admin/error');
		} else {

			$data_tahun = $this->adminmodel->selectdata('data_tahun where no_tahun = "' . $id . '"')->result_array();

			$data = array(
				'title'				=> '.:: Edit Data Tahun ::. ',
				'titlesistem'	=> $this->model->getTitle(),
				'nama'				=> $sesinya['nama'],
				'no_tahun'				=> $data_tahun[0]['no_tahun'],
				'status'			=> 'edit',
				'nama_tahun'			=> $data_tahun[0]['nama_tahun'],

			);

			$this->load->view('admin/header', $data);
			$this->load->view('admin/data_tahun_form');
			$this->load->view('admin/footer');
		}
	}

	function data_tahun_del($id = '')
	{
		$hasil	= $this->adminmodel->deldata('data_tahun', array('no_tahun' => $id));
		$sukses = '
					<div class="alert alert-success">
					  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					  <strong>Sukses!</strong> Data anda berhasil dihapus.
					</div>
				';
		$this->session->set_flashdata('sukses', $sukses);
		redirect('administrasi/data_tahun');
	}


	function data_fasilitas_view()
	{

		$this->load->library('session');
		$sesinya	= $this->session->userdata('login');
		if ($sesinya['level'] != '1') {

			$this->load->view('admin/error');
		} else {

			$data_fasilitas = $this->adminmodel->selectdata('data_fasilitas order by no_fasilitas desc')->result_array();

			$data = array(
				'title'			=> '.:: Data Fasilitas ::. ',
				'nama'			=> $sesinya['nama'],
				'data_fasilitas'		=> $data_fasilitas,
				'titlesistem'	=> $this->model->getTitle(),
			);

			$this->load->view('admin/header', $data);
			$this->load->view('admin/data_fasilitas');
			$this->load->view('admin/footer');
		}
	}

	function data_fasilitas_add()
	{
		$this->load->library('session');
		$sesinya	= $this->session->userdata('login');
		if ($sesinya['level'] != '1') {

			$this->load->view('admin/error');
		} else {

			$data = array(
				'title'				=> '.:: Tambah Data Fasilitas ::. ',
				'nama'				=> $sesinya['nama'],
				'titlesistem'		=> $this->model->getTitle(),
				'no_fasilitas'		=> '',
				'status'			=> 'baru',
				'nama_fasilitas'		=> '',

			);

			$this->load->view('admin/header', $data);
			$this->load->view('admin/data_fasilitas_form');
			$this->load->view('admin/footer');
		}
	}

	function data_fasilitas_save()
	{
		if ($_POST) {

			$status 			= $this->input->post('status');
			$no_fasilitas 				= $this->input->post('no_fasilitas');
			$nama_fasilitas				= $this->input->post('nama_fasilitas');

			if ($status == 'baru') {
				$data = array(
					'nama_fasilitas'	=> $nama_fasilitas,
				);
				$sukses = '
					<div class="alert alert-success">
					  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					  <strong>Sukses!</strong> Data anda telah tesimpan.
					</div>
				';
				$this->session->set_flashdata('sukses', $sukses);
				$this->adminmodel->insertdata('data_fasilitas', $data);
				redirect('administrasi/data_fasilitas');
			} else {
				$data = array(
					'nama_fasilitas'	=> $nama_fasilitas,
				);
				$sukses = '
					<div class="alert alert-success">
					  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					  <strong>Sukses!</strong> Data anda telah diperbarui.
					</div>
				';
				$this->session->set_flashdata('sukses', $sukses);
				$this->adminmodel->updatedata('data_fasilitas', $data, array('no_fasilitas' => $no_fasilitas));
				redirect('administrasi/data_fasilitas');
			}
		} else {
			$this->load->view('admin/error');
		}
	}


	function data_fasilitas_edit($id = '')
	{
		$this->load->library('session');
		$sesinya	= $this->session->userdata('login');
		if ($sesinya['level'] != '1') {

			$this->load->view('admin/error');
		} else {

			$data_fasilitas = $this->adminmodel->selectdata('data_fasilitas where no_fasilitas = "' . $id . '"')->result_array();

			$data = array(
				'title'				=> '.:: Edit Data Tahun ::. ',
				'titlesistem'	=> $this->model->getTitle(),
				'nama'				=> $sesinya['nama'],
				'no_fasilitas'				=> $data_fasilitas[0]['no_fasilitas'],
				'status'			=> 'edit',
				'nama_fasilitas'			=> $data_fasilitas[0]['nama_fasilitas'],

			);

			$this->load->view('admin/header', $data);
			$this->load->view('admin/data_fasilitas_form');
			$this->load->view('admin/footer');
		}
	}

	function data_fasilitas_del($id = '')
	{
		$hasil	= $this->adminmodel->deldata('data_fasilitas', array('no_fasilitas' => $id));
		$sukses = '
					<div class="alert alert-success">
					  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					  <strong>Sukses!</strong> Data anda berhasil dihapus.
					</div>
				';
		$this->session->set_flashdata('sukses', $sukses);
		redirect('administrasi/data_fasilitas');
	}


	function data_jumlah_tujuan_loket_view()
	{

		$this->load->library('session');
		$sesinya	= $this->session->userdata('login');
		if ($sesinya['level'] != '1') {

			$this->load->view('admin/error');
		} else {

			// $data_jumlah_tujuan_loket = $this->adminmodel->selectdata('jumlah_tujuan_loket order by no_jumlah_tujuan desc')->result_array();

			$data_jumlah_tujuan_loket = $this->adminmodel->selectdata('jumlah_tujuan_loket INNER JOIN data_tahun ON jumlah_tujuan_loket.no_tahun = data_tahun.no_tahun INNER JOIN data_loket on jumlah_tujuan_loket.no_loket = data_loket.no_loket INNER JOIN data_tujuan on jumlah_tujuan_loket.no_tujuan=data_tujuan.no_tujuan LEFT JOIN data_bus on data_tujuan.no=data_bus.no')->result_array();

			// $this->db->select('*');    
			// $this->db->from('table1');
			// $this->db->join('table2', 'table1.id = table2.id');
			// $this->db->join('table3', 'table1.id = table3.id');
			// $query = $this->db->get();

			$data = array(
				'title'			=> '.:: Data Jumlah tujuan ::. ',
				'nama'			=> $sesinya['nama'],
				'data_jumlah_tujuan_loket'		=> $data_jumlah_tujuan_loket,
				'titlesistem'	=> $this->model->getTitle(),
			);

			$this->load->view('admin/header', $data);
			$this->load->view('admin/data_jumlah_tujuan_loket');
			$this->load->view('admin/footer');
		}
	}

	function data_jumlah_tujuan_loket_add()
	{
		$this->load->library('session');
		$sesinya	= $this->session->userdata('login');
		if ($sesinya['level'] != '1') {

			$this->load->view('admin/error');
		} else {
			$pilih_tahun = $this->adminmodel->selectdata('data_tahun order by no_tahun desc')->result_array();
			$pilih_loket = $this->adminmodel->selectdata('data_loket order by no_loket desc')->result_array();
			$pilih_tujuan = $this->adminmodel->selectdata('data_tujuan order by no_tujuan desc')->result_array();

			$data = array(
				'title'				=> '.:: Tambah Data Jumlah ::. ',
				'nama'				=> $sesinya['nama'],
				'titlesistem'		=> $this->model->getTitle(),
				'no_jumlah_tujuan'		=> '',
				'status'			=> 'baru',
				'no_tahun'			=> $pilih_tahun,
				'no_loket'		=> $pilih_loket,
				'nama_penumpang'			=> '',
				'no_tujuan'		=> $pilih_tujuan,

			);

			$this->load->view('admin/header', $data);
			$this->load->view('admin/data_jumlah_tujuan_loket_form');
			$this->load->view('admin/footer');
		}
	}

	function data_jumlah_tujuan_loket_save()
	{
		if ($_POST) {

			$status 				= $this->input->post('status');
			$no_jumlah_tujuan		= $this->input->post('no_jumlah_tujuan');
			$no_tahun				= $this->input->post('no_tahun');
			$no_loket			= $this->input->post('no_loket');
			$nama_penumpang			= $this->input->post('nama_penumpang');
			$no_tujuan				= $this->input->post('no_tujuan');

			if ($status == 'baru') {
				$data = array(
					'no_tahun'	=> $no_jumlah_tujuan,
					'no_loket'	=> $no_loket,
					'nama_penumpang'	=> $nama_penumpang,
					'no_tujuan'	=> $no_tujuan,
					'no_tahun'	=> $no_tahun,
				);
				$sukses = '
					<div class="alert alert-success">
					  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					  <strong>Sukses!</strong> Data anda telah tesimpan.
					</div>
				';
				$this->session->set_flashdata('sukses', $sukses);
				$this->adminmodel->insertdata('jumlah_tujuan_loket', $data);
				redirect('administrasi/data_jumlah_tujuan_loket');
			} else {
				$data = array(
					'no_tahun'	=> $no_jumlah_tujuan,
					'no_loket'	=> $no_loket,
					'nama_penumpang'	=> $nama_penumpang,
					'no_tujuan'	=> $no_tujuan,
					'no_tahun'	=> $no_tahun,
				);
				$sukses = '
					<div class="alert alert-success">
					  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					  <strong>Sukses!</strong> Data anda telah diperbarui.
					</div>
				';
				$this->session->set_flashdata('sukses', $sukses);
				$this->adminmodel->updatedata('jumlah_tujuan_loket', $data, array('no_jumlah_tujuan' => $no_jumlah_tujuan));
				redirect('administrasi/data_jumlah_tujuan_loket');
			}
		} else {
			$this->load->view('admin/error');
		}
	}


	function data_jumlah_tujuan_loket_edit($id = '')
	{
		$this->load->library('session');
		$sesinya	= $this->session->userdata('login');
		if ($sesinya['level'] != '1') {

			$this->load->view('admin/error');
		} else {

			$jumlah_tujuan_loket = $this->adminmodel->selectdata('jumlah_tujuan_loket where no_jumlah_tujuan = "' . $id . '"')->result_array();
			$pilih_tahun = $this->adminmodel->selectdata('data_tahun order by no_tahun desc')->result_array();
			$pilih_loket = $this->adminmodel->selectdata('data_loket order by no_loket desc')->result_array();
			$pilih_tujuan = $this->adminmodel->selectdata('data_tujuan order by no_tujuan desc')->result_array();

			$data = array(
				'title'				=> '.:: Edit Data Jumlah tujuan ::. ',
				'titlesistem'	=> $this->model->getTitle(),
				'nama'				=> $sesinya['nama'],
				'no_jumlah_tujuan'				=> $jumlah_tujuan_loket[0]['no_jumlah_tujuan'],
				'status'			=> 'edit',
				'no_tahun'			=> $pilih_tahun,
				'no_loket'			=> $pilih_loket,
				'nama_penumpang'				=> $jumlah_tujuan_loket[0]['nama_penumpang'],
				'no_tujuan'			=> $pilih_tujuan,

			);

			$this->load->view('admin/header', $data);
			$this->load->view('admin/data_jumlah_tujuan_loket_form');
			$this->load->view('admin/footer');
		}
	}

	function data_jumlah_tujuan_loket_del($id = '')
	{
		$hasil	= $this->adminmodel->deldata('jumlah_tujuan_loket', array('no_jumlah_tujuan' => $id));
		$sukses = '
					<div class="alert alert-success">
					  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					  <strong>Sukses!</strong> Data anda berhasil dihapus.
					</div>
				';
		$this->session->set_flashdata('sukses', $sukses);
		redirect('administrasi/data_jumlah_tujuan_loket');
	}

	function data_jumlah_fasilitas_loket_view()
	{

		$this->load->library('session');
		$sesinya	= $this->session->userdata('login');
		if ($sesinya['level'] != '1') {

			$this->load->view('admin/error');
		} else {

			$data_jumlah_fasilitas_loket = $this->adminmodel->selectdata('jumlah_fasilitas_loket LEFT JOIN data_loket on jumlah_fasilitas_loket.no_loket = data_loket.no_loket LEFT JOIN data_fasilitas on jumlah_fasilitas_loket.no_fasilitas=data_fasilitas.no_fasilitas')->result_array();

			$data = array(
				'title'			=> '.:: Data Fasilitas tujuan ::. ',
				'nama'			=> $sesinya['nama'],
				'data_jumlah_fasilitas_loket'		=> $data_jumlah_fasilitas_loket,
				'titlesistem'	=> $this->model->getTitle(),
			);

			$this->load->view('admin/header', $data);
			$this->load->view('admin/data_jumlah_fasilitas_loket');
			$this->load->view('admin/footer');
		}
	}

	function data_jumlah_fasilitas_loket_add()
	{
		$this->load->library('session');
		$sesinya	= $this->session->userdata('login');
		if ($sesinya['level'] != '1') {

			$this->load->view('admin/error');
		} else {
			$pilih_loket = $this->adminmodel->selectdata('data_loket order by no_loket desc')->result_array();
			$pilih_fasilitas = $this->adminmodel->selectdata('data_fasilitas order by no_fasilitas desc')->result_array();

			$data = array(
				'title'				=> '.:: Tambah Data Fasilitas ::. ',
				'nama'				=> $sesinya['nama'],
				'titlesistem'		=> $this->model->getTitle(),
				'no_jumlah_fasilitas'		=> '',
				'status'			=> 'baru',
				'no_loket'		=> $pilih_loket,
				'no_fasilitas'		=> $pilih_fasilitas,
				'jumlah_fasilitas'			=> '',

			);

			$this->load->view('admin/header', $data);
			$this->load->view('admin/data_jumlah_fasilitas_loket_form');
			$this->load->view('admin/footer');
		}
	}

	function data_jumlah_fasilitas_loket_save()
	{
		if ($_POST) {

			$status 				= $this->input->post('status');
			$no_jumlah_fasilitas		= $this->input->post('no_jumlah_fasilitas');
			$no_loket			= $this->input->post('no_loket');
			$no_fasilitas				= $this->input->post('no_fasilitas');
			$jumlah_fasilitas			= $this->input->post('jumlah_fasilitas');

			if ($status == 'baru') {
				$data = array(
					'no_loket'	=> $no_loket,
					'no_fasilitas'	=> $no_fasilitas,
					'jumlah_fasilitas'	=> $jumlah_fasilitas,
				);
				$sukses = '
					<div class="alert alert-success">
					  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					  <strong>Sukses!</strong> Data anda telah tesimpan.
					</div>
				';
				$this->session->set_flashdata('sukses', $sukses);
				$this->adminmodel->insertdata('jumlah_fasilitas_loket', $data);
				redirect('administrasi/data_jumlah_fasilitas_loket');
			} else {
				$data = array(
					'no_loket'	=> $no_loket,
					'no_fasilitas'	=> $no_fasilitas,
					'jumlah_fasilitas'	=> $jumlah_fasilitas,
				);
				$sukses = '
					<div class="alert alert-success">
					  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					  <strong>Sukses!</strong> Data anda telah diperbarui.
					</div>
				';
				$this->session->set_flashdata('sukses', $sukses);
				$this->adminmodel->updatedata('jumlah_fasilitas_loket', $data, array('no_jumlah_fasilitas' => $no_jumlah_fasilitas));
				redirect('administrasi/data_jumlah_fasilitas_loket');
			}
		} else {
			$this->load->view('admin/error');
		}
	}


	function data_jumlah_fasilitas_loket_edit($id = '')
	{
		$this->load->library('session');
		$sesinya	= $this->session->userdata('login');
		if ($sesinya['level'] != '1') {

			$this->load->view('admin/error');
		} else {

			$jumlah_fasilitas_loket = $this->adminmodel->selectdata('jumlah_fasilitas_loket where no_jumlah_fasilitas = "' . $id . '"')->result_array();
			$pilih_loket = $this->adminmodel->selectdata('data_loket order by no_loket desc')->result_array();
			$pilih_fasilitas = $this->adminmodel->selectdata('data_fasilitas order by no_fasilitas desc')->result_array();

			$data = array(
				'title'					=> '.:: Edit Data Jumlah tujuan ::. ',
				'titlesistem'			=> $this->model->getTitle(),
				'nama'					=> $sesinya['nama'],
				'no_jumlah_fasilitas'	=> $jumlah_fasilitas_loket[0]['no_jumlah_fasilitas'],
				'status'			=> 'edit',
				'no_loket'			=> $pilih_loket,
				'no_fasilitas'			=> $pilih_fasilitas,
				'jumlah_fasilitas'		=> $jumlah_fasilitas_loket[0]['jumlah_fasilitas'],

			);

			$this->load->view('admin/header', $data);
			$this->load->view('admin/data_jumlah_fasilitas_loket_form');
			$this->load->view('admin/footer');
		}
	}

	function data_jumlah_fasilitas_loket_del($id = '')
	{
		$hasil	= $this->adminmodel->deldata('jumlah_fasilitas_loket', array('no_jumlah_fasilitas' => $id));
		$sukses = '
					<div class="alert alert-success">
					  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					  <strong>Sukses!</strong> Data anda berhasil dihapus.
					</div>
				';
		$this->session->set_flashdata('sukses', $sukses);
		redirect('administrasi/data_jumlah_fasilitas_loket');
	}

	function data_jumlah_bus_loket_view()
	{

		$this->load->library('session');
		$sesinya	= $this->session->userdata('login');
		if ($sesinya['level'] != '1') {

			$this->load->view('admin/error');
		} else {

			$data_jumlah_bus_loket = $this->adminmodel->selectdata('jumlah_bus_loket LEFT JOIN data_loket on jumlah_bus_loket.no_loket = data_loket.no_loket LEFT JOIN data_bus on jumlah_bus_loket.no=data_bus.no')->result_array();

			$data = array(
				'title'			=> '.:: Data bus tujuan ::. ',
				'nama'			=> $sesinya['nama'],
				'data_jumlah_bus_loket'		=> $data_jumlah_bus_loket,
				'titlesistem'	=> $this->model->getTitle(),
			);

			$this->load->view('admin/header', $data);
			$this->load->view('admin/data_jumlah_bus_loket');
			$this->load->view('admin/footer');
		}
	}

	function data_jumlah_bus_loket_add()
	{
		$this->load->library('session');
		$sesinya	= $this->session->userdata('login');
		if ($sesinya['level'] != '1') {

			$this->load->view('admin/error');
		} else {
			$pilih_loket = $this->adminmodel->selectdata('data_loket order by no_loket desc')->result_array();
			$pilih_bus = $this->adminmodel->selectdata('data_bus order by no desc')->result_array();

			$data = array(
				'title'				=> '.:: Tambah Data bus ::. ',
				'nama'				=> $sesinya['nama'],
				'titlesistem'		=> $this->model->getTitle(),
				'no_jumlah_bus'		=> '',
				'status'			=> 'baru',
				'no_loket'		=> $pilih_loket,
				'no'		=> $pilih_bus,
				'jumlah_bus'			=> '',

			);

			$this->load->view('admin/header', $data);
			$this->load->view('admin/data_jumlah_bus_loket_form');
			$this->load->view('admin/footer');
		}
	}

	function data_jumlah_bus_loket_save()
	{
		if ($_POST) {

			$status 				= $this->input->post('status');
			$no_jumlah_bus		= $this->input->post('no_jumlah_bus');
			$no_loket			= $this->input->post('no_loket');
			$no				= $this->input->post('no');
			$jumlah_bus			= $this->input->post('jumlah_bus');

			if ($status == 'baru') {
				$data = array(
					'no_loket'	=> $no_loket,
					'no'	=> $no,
					'jumlah_bus'	=> $jumlah_bus,
				);
				$sukses = '
					<div class="alert alert-success">
					  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					  <strong>Sukses!</strong> Data anda telah tesimpan.
					</div>
				';
				$this->session->set_flashdata('sukses', $sukses);
				$this->adminmodel->insertdata('jumlah_bus_loket', $data);
				redirect('administrasi/data_jumlah_bus_loket');
			} else {
				$data = array(
					'no_loket'	=> $no_loket,
					'no'	=> $no,
					'jumlah_bus'	=> $jumlah_bus,
				);
				$sukses = '
					<div class="alert alert-success">
					  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					  <strong>Sukses!</strong> Data anda telah diperbarui.
					</div>
				';
				$this->session->set_flashdata('sukses', $sukses);
				$this->adminmodel->updatedata('jumlah_bus_loket', $data, array('no_jumlah_bus' => $no_jumlah_bus));
				redirect('administrasi/data_jumlah_bus_loket');
			}
		} else {
			$this->load->view('admin/error');
		}
	}


	function data_jumlah_bus_loket_edit($id = '')
	{
		$this->load->library('session');
		$sesinya	= $this->session->userdata('login');
		if ($sesinya['level'] != '1') {

			$this->load->view('admin/error');
		} else {

			$jumlah_bus_loket = $this->adminmodel->selectdata('jumlah_bus_loket where no_jumlah_bus = "' . $id . '"')->result_array();
			$pilih_loket = $this->adminmodel->selectdata('data_loket order by no_loket desc')->result_array();
			$pilih_bus = $this->adminmodel->selectdata('data_bus order by no desc')->result_array();

			$data = array(
				'title'					=> '.:: Edit Data Jumlah tujuan ::. ',
				'titlesistem'			=> $this->model->getTitle(),
				'nama'					=> $sesinya['nama'],
				'no_jumlah_bus'	=> $jumlah_bus_loket[0]['no_jumlah_bus'],
				'status'			=> 'edit',
				'no_loket'			=> $pilih_loket,
				'no'			=> $pilih_bus,
				'jumlah_bus'		=> $jumlah_bus_loket[0]['jumlah_bus'],

			);

			$this->load->view('admin/header', $data);
			$this->load->view('admin/data_jumlah_bus_loket_form');
			$this->load->view('admin/footer');
		}
	}

	function data_jumlah_bus_loket_del($id = '')
	{
		$hasil	= $this->adminmodel->deldata('jumlah_bus_loket', array('no_jumlah_bus' => $id));
		$sukses = '
					<div class="alert alert-success">
					  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					  <strong>Sukses!</strong> Data anda berhasil dihapus.
					</div>
				';
		$this->session->set_flashdata('sukses', $sukses);
		redirect('administrasi/data_jumlah_bus_loket');
	}

	function logout()
	{
		$this->session->sess_destroy();
		redirect('');
	}

	// function random(){
	// 	$pilih_tujuan = $this->adminmodel->selectdata('data_tujuan order by no_tujuan desc')->result_array();
	// 	$pilih_tahun = $this->adminmodel->selectdata('data_tahun order by no_tahun desc')->result_array();
	// 	$pilih_loket = $this->adminmodel->selectdata('data_loket order by no_loket desc')->result_array();
	// 	$pilih_pasien = $this->adminmodel->selectdata('data_pasien order by no_pasien desc')->result_array();

	// 	$max_1 = count($pilih_tujuan);
	// 	$max_2 = count($pilih_tahun);
	// 	$max_3 = count($pilih_loket);
	// 	$max_4 = count($pilih_pasien);
	// 	//echo $max_1." ".$max_2." ".$max_3." ".$max_4;
	// 	echo "<hr>";
	// 	for($i=1;$i<=1000;$i++){
	// 		$no_tahun = $pilih_tahun[rand(0,$i)]['no_tahun'];
	// 		$no_loket = $pilih_loket[rand(0,$i)]['no_loket'];
	// 		$nama_pasien = $pilih_pasien[rand(0,$i)]['nama_pasien']." ".$pilih_pasien[rand(0,$i)]['nama_pasien'];
	// 		$no_tujuan = $pilih_tujuan[rand(0,$i)]['no_tujuan'];
	// 		echo $no_tahun."<br>";
	// 		$no_loket = 102;
	// 		echo $no_loket."<br>";
	// 		echo $nama_pasien."<br>";
	// 		echo $no_tujuan."<br><br>";

	// 		$data = array(
	// 				'no_loket'	=> $no_loket,
	// 				'nama_pasien'	=> $nama_pasien,
	// 				'no_tujuan'	=> $no_tujuan,
	// 				'no_tahun'		=> $no_tahun,
	// 		);
	// 		$this->adminmodel->insertdata('jumlah_tujuan_loket',$data);
	// 	}

	// }


	// function random(){
	// 	$pilih_fasilitas = $this->adminmodel->selectdata('data_fasilitas order by no_fasilitas desc')->result_array();
	// 	$pilih_loket = $this->adminmodel->selectdata('data_loket order by no_loket desc')->result_array();

	// 	$max_1 = count($pilih_fasilitas);
	// 	$max_2 = count($pilih_loket);
	// 	echo "<hr>";
	// 	for($i=1;$i<=100;$i++){
	// 		$no_loket = $pilih_loket[rand(0,$i)]['no_loket'];
	// 		$no_fasilitas = $pilih_fasilitas[rand(0,$i)]['no_fasilitas'];
	// 		$no_loket = 102;
	// 		$jumlah_fasilitas = rand(1,80);
	// 		echo $no_loket."<br>";
	// 		echo $no_fasilitas."<br>";
	// 		echo $jumlah_fasilitas."<br><br>";

	// 		$data = array(
	// 				'no_loket'	=> $no_loket,
	// 				'no_fasilitas'	=> $no_fasilitas,
	// 				'jumlah_fasilitas'	=> $jumlah_fasilitas,
	// 		);
	// 		$this->adminmodel->insertdata('jumlah_fasilitas_loket',$data);
	// 	}

	// }

	// function random(){
	// 	$pilih_bus = $this->adminmodel->selectdata('data_bus order by no desc')->result_array();
	// 	$pilih_loket = $this->adminmodel->selectdata('data_loket order by no_loket desc')->result_array();

	// 	$max_1 = count($pilih_bus);
	// 	$max_2 = count($pilih_loket);
	// 	echo "<hr>";
	// 	for($i=1;$i<=100;$i++){
	// 		$no_loket = $pilih_loket[rand(0,$i)]['no_loket'];
	// 		$no = $pilih_bus[rand(0,$i)]['no'];
	// 		$no_loket = 102;
	// 		$jumlah_bus = rand(1,80);
	// 		echo $no_loket."<br>";
	// 		echo $no."<br>";
	// 		echo $jumlah_bus."<br><br>";

	// 		$data = array(
	// 				'no_loket'	=> $no_loket,
	// 				'no'	=> $no,
	// 				'jumlah_bus'	=> $jumlah_bus,
	// 		);
	// 		$this->adminmodel->insertdata('jumlah_bus_loket',$data);
	// 	}

	// }

	/*
	
	SELECT data_loket.no_loket,data_loket.nama_loket, ROUND(AVG(jumlah_fasilitas_loket.jumlah_fasilitas)) AS jumlah_fasilitas_total,ROUND(AVG(jumlah_bus_loket.jumlah_bus)) AS ketersediaan_bus_total,ROUND(AVG(jumlah_tujuan_loket.no_tujuan-20)) AS jumlah_pasien_total from data_loketINNER JOIN jumlah_fasilitas_loket on jumlah_fasilitas_loket.no_loket=data_loket.no_loket INNER JOIN jumlah_tujuan_loket on jumlah_tujuan_loket.no_loket=data_loket.no_loket INNER JOIN jumlah_bus_loket on jumlah_bus_loket.no_loket=data_loket.no_loket GROUP by data_loket.no_loket

	*/
}
