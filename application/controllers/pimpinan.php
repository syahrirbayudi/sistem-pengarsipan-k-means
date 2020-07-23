<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pimpinan extends CI_Controller
{

	function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('login') != TRUE) {
			$this->load->view('pimpinan/error');
		}

		$this->load->model('pimpinanmodel');
		$this->load->model('model');
	}

	function index()
	{

		$sesinya	= $this->session->userdata('login');
		if ($sesinya['level'] != '2') {

			$this->load->view('pimpinan/error');
		} else {

			$this->load->model('model');
			$data = array(
				'title'			=> '.:: Selamat Datang Pimpinan ::. ',
				'nama'			=> $sesinya['nama'],
				'petunjuk'		=> $this->model->getPetunjuk(),
				'wewenang'		=> $this->model->getWewenang(),
				'titlesistem'	=> $this->model->getTitle(),
			);

			$this->load->view('pimpinan/header', $data);
			$this->load->view('pimpinan/dashboard');
			$this->load->view('pimpinan/footer');
		}
	}


	function cetak_loket()
	{

		$this->load->library('session');
		$sesinya	= $this->session->userdata('login');
		if ($sesinya['level'] != '2') {

			$this->load->view('pimpinan/error');
		} else {

			$data_loket = $this->pimpinanmodel->selectdata('data_loket order by no_loket desc')->result_array();

			$data = array(
				'title'			=> '.:: Cetak Data loket ::. ',
				'nama'			=> $sesinya['nama'],
				'data_loket'		=> $data_loket,
				'titlesistem'	=> $this->model->getTitle(),
			);

			$this->load->view('pimpinan/header', $data);
			$this->load->view('pimpinan/cetak_loket');
			$this->load->view('pimpinan/footer');
		}
	}

	function cetak_bus()
	{

		$this->load->library('session');
		$sesinya	= $this->session->userdata('login');
		if ($sesinya['level'] != '2') {

			$this->load->view('pimpinan/error');
		} else {

			$data_bus = $this->pimpinanmodel->selectdata('data_bus order by no desc')->result_array();

			$data = array(
				'title'			=> '.:: Cetak Data Bus ::. ',
				'nama'			=> $sesinya['nama'],
				'data_bus'		=> $data_bus,
				'titlesistem'	=> $this->model->getTitle(),
			);

			$this->load->view('pimpinan/header', $data);
			$this->load->view('pimpinan/cetak_bus');
			$this->load->view('pimpinan/footer');
		}
	}

	function cetak_tujuan()
	{

		$this->load->library('session');
		$sesinya	= $this->session->userdata('login');
		if ($sesinya['level'] != '2') {

			$this->load->view('pimpinan/error');
		} else {

			$data_tujuan = $this->pimpinanmodel->selectdata('data_tujuan LEFT JOIN data_bus on data_tujuan.no=data_bus.no')->result_array();

			$data = array(
				'title'			=> '.:: Cetak Data Tujuan ::. ',
				'nama'			=> $sesinya['nama'],
				'data_tujuan'		=> $data_tujuan,
				'titlesistem'	=> $this->model->getTitle(),
			);

			$this->load->view('pimpinan/header', $data);
			$this->load->view('pimpinan/cetak_tujuan');
			$this->load->view('pimpinan/footer');
		}
	}

	function cetak_tujuan_view()
	{

		$this->load->library('session');
		$sesinya	= $this->session->userdata('login');
		if ($sesinya['level'] != '2') {

			$this->load->view('pimpinan/error');
		} else {

			$this->load->library('Pdf');

			$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

			$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
			$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
			$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
			$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
			$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
			$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

			if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
				require_once(dirname(__FILE__) . '/lang/eng.php');
				$pdf->setLanguageArray($l);
			}

			$pdf->SetPrintHeader(false);
			$pdf->SetPrintFooter(false);
			$pdf->AddPage();
			$pdf->Image(base_url() . 'assets/img/logo-SMA.png', 15, 15, 25, 25, 'PNG', '', '', true, 150, '', false, false, 0, false, false, false);
			$pdf->SetFont('helvetica', 'B', 14);
			$pdf->Write(0, 'SISTEM INFORMASI PENGARSIPAN', '', 0, 'C', true, 0, false, false, 0);
			$pdf->Write(0, 'PO MEDAN JAYA', '', 0, 'C', true, 0, false, false, 0);
			$pdf->Write(0, 'SUMATERA UTARA', '', 0, 'C', true, 0, false, false, 0);
			$pdf->SetFont('helvetica', '', 9);
			$pdf->Write(0, 'Jalan Sisingamangaraja' . ' Telp. 061-7880725', '', 0, 'C', true, 0, false, false, 0);
			$pdf->Write(0, 'Email : admin@dinkesbandaaceh.or.id Kode Pos : 65144', '', 0, 'C', true, 0, false, false, 0);

			$pdf->Ln();

			//header
			$data_tujuan = $this->pimpinanmodel->selectdata('data_tujuan LEFT JOIN data_bus on data_tujuan.no=data_bus.no')->result_array();
			$pdf->SetFont('helvetica', '', 12);

			$tbl_header = '
		<table cellspacing="0" cellpadding="5" border="1">
			<tr>
				<td colspan="2" align="center">LAPORAN DATA TUJUAN</td>
			</tr>
		</table>';

			$tbl_header .= '
		<table border="1" align="center">
		<thead><tr><th>No</th><th>Nama Tujuan</th><th>Nama bus</th></tr></thead>
        <tbody>';

			$tbl = '';


			foreach ($data_tujuan as $p) {

				$busa = (!$p["merk_bus"]) ? 'Tidak Tersedia' : ucfirst($p["merk_bus"]);
				//$nama_tujuan = $this->db->query('SELECT COUNT(no_tujuan) as nama_tujuan FROM data_tujuan WHERE no_tujuan = ' . $pp['no_tujuan']);
				$tbl .= '<tr><td style="border:1px solid #000;text-align:center">' . $p["no_tujuan"] . '</td>';
				$tbl .= '<td style="border:1px solid #000;text-align:center">' . $p["nama_tujuan"] . '</td>';
				$tbl .= '<td style="border:1px solid #000;text-align:center">' . $busa . '</td>    </tr>';

				//$tbl .= '<td style="border:1px solid #000;text-align:center">' . $nama_tujuan->row()->no_tujuan . '</td>';
			}

			$tbl_footer = "</table>";


			$pdf->writeHTML($tbl_header . $tbl . $tbl_footer, true, false, false, false, '');
			$pdf->Output('cetak_tujuan.pdf', 'I');

			//pdf
		}
	}

	function cetak_bus_view()
	{

		$this->load->library('session');
		$sesinya	= $this->session->userdata('login');
		if ($sesinya['level'] != '2') {

			$this->load->view('pimpinan/error');
		} else {




			$this->load->library('Pdf');

			$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

			$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
			$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
			$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
			$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
			$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
			$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

			if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
				require_once(dirname(__FILE__) . '/lang/eng.php');
				$pdf->setLanguageArray($l);
			}

			$pdf->SetPrintHeader(false);
			$pdf->SetPrintFooter(false);
			$pdf->AddPage();
			$pdf->Image(base_url() . 'assets/img/logo-SMA.png', 15, 15, 25, 25, 'PNG', '', '', true, 150, '', false, false, 0, false, false, false);
			$pdf->SetFont('helvetica', 'B', 14);
			$pdf->Write(0, 'SISTEM INFORMASI PENGARSIPAN', '', 0, 'C', true, 0, false, false, 0);
			$pdf->Write(0, 'DINAS KESEHATAN', '', 0, 'C', true, 0, false, false, 0);
			$pdf->Write(0, 'KABUPATEN BANDA ACEH', '', 0, 'C', true, 0, false, false, 0);
			$pdf->SetFont('helvetica', '', 9);
			$pdf->Write(0, 'Jalan Banda Aceh 12' . ' Telp. 0341-210-0232', '', 0, 'C', true, 0, false, false, 0);
			$pdf->Write(0, 'Email : admin@dinkesbandaaceh.or.id Kode Pos : 65144', '', 0, 'C', true, 0, false, false, 0);
			$pdf->Write(0, 'Peringkat Akreditasi : A Nomor : 200/BAP-S/M/TU/XI/2015 Tanggal 22 Desember 2015', '', 0, 'C', true, 0, false, false, 0);
			$pdf->Ln();

			//header
			$data_bus = $this->pimpinanmodel->selectdata('data_bus order by no desc')->result_array();
			$pdf->SetFont('helvetica', '', 12);

			$tbl_header = '
		<table cellspacing="0" cellpadding="5" border="1">
			<tr>
				<td colspan="2" align="center">LAPORAN DATA BUS</td>
			</tr>
		</table>';

			$tbl_header .= '
		<table border="1" align="center">
		<thead><tr><th>No</th><th>Merk Bus bus</th><th>Kelas Bus</th><th>Jumlah Tujuan</th><th>Jumlah Kursi</th></tr></thead>
        <tbody>';

			$tbl = '';


			foreach ($data_bus as $p) {
				$tbl .= '<tr><td style="border:1px solid #000;text-align:center">' . $p["no"] . '</td>';
				$tbl .= '<td style="border:1px solid #000;text-align:center">' . $p["merk_bus"] . '</td>';
				$tbl .= '<td style="border:1px solid #000;text-align:center">' . $p["kelas_bus"] . '</td>';
				$tbl .= '<td style="border:1px solid #000;text-align:center">' . $p["jumlah_tujuan"] . '</td>';
				$tbl .= '<td style="border:1px solid #000;text-align:center">' . $p["jumlah_kursi"] . '</td></tr>';
			}

			$tbl_footer = "</table>";


			$pdf->writeHTML($tbl_header . $tbl . $tbl_footer, true, false, false, false, '');
			$pdf->Output('cetak_bus.pdf', 'I');

			//pdf
		}
	}


	function cetak_loket_view()
	{

		$this->load->library('session');
		$sesinya	= $this->session->userdata('login');
		if ($sesinya['level'] != '2') {

			$this->load->view('pimpinan/error');
		} else {




			$this->load->library('Pdf');

			$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

			$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
			$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
			$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
			$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
			$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
			$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

			if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
				require_once(dirname(__FILE__) . '/lang/eng.php');
				$pdf->setLanguageArray($l);
			}

			$pdf->SetPrintHeader(false);
			$pdf->SetPrintFooter(false);
			$pdf->AddPage();
			$pdf->Image(base_url() . 'assets/img/logo-SMA.png', 15, 15, 25, 25, 'PNG', '', '', true, 150, '', false, false, 0, false, false, false);
			$pdf->SetFont('helvetica', 'B', 14);
			$pdf->Write(0, 'SISTEM INFORMASI PENGARSIPAN', '', 0, 'C', true, 0, false, false, 0);
			$pdf->Write(0, 'PO MEDAN JAYA', '', 0, 'C', true, 0, false, false, 0);
			$pdf->Write(0, 'SUMATERA UTARA', '', 0, 'C', true, 0, false, false, 0);
			$pdf->SetFont('helvetica', '', 9);
			$pdf->Write(0, 'JL SISINGAMANGARAJA ' . ' Telp. 061-7880725', '', 0, 'C', true, 0, false, false, 0);
			$pdf->Write(0, 'Email : medanjaya@gmail.com Kode Pos : 65144', '', 0, 'C', true, 0, false, false, 0);

			$pdf->Ln();

			//header
			$data_loket = $this->pimpinanmodel->selectdata('data_loket order by no_loket desc')->result_array();
			$pdf->SetFont('helvetica', '', 12);

			$tbl_header = '
		<table cellspacing="0" cellpadding="5" border="1">
			<tr>
				<td colspan="2" align="center">LAPORAN DATA LOKET</td>
			</tr>
		</table>';

			$tbl_header .= '
		<table border="1" align="center">
		<thead><tr><th>No</th><th>Nama loket</th><th>Jumlah Penumpang</th><th>Ketersediaan bus</th><th>Jumlah fasilitas</th></tr></thead>
        <tbody>';

			$tbl = '';


			foreach ($data_loket as $pp) {
				$jumlah_penumpang_total = $this->db->query('SELECT COUNT(no_tujuan) as jumlah_penumpang FROM jumlah_tujuan_loket WHERE no_loket = ' . $pp['no_loket']);
				$ketersediaan_bus_total = $this->db->query('SELECT SUM(jumlah_bus) as jumlah_bus FROM jumlah_bus_loket WHERE no_loket = ' . $pp['no_loket']);
				$jumlah_fasilitas_total = $this->db->query('SELECT SUM(jumlah_fasilitas) as jumlah_fasilitas FROM jumlah_fasilitas_loket WHERE no_loket = ' . $pp['no_loket']);
				$tbl .= '<tr><td style="border:1px solid #000;text-align:center">' . $pp["no_loket"] . '</td>';
				$tbl .= '<td style="border:1px solid #000;text-align:center">' . $pp["nama_loket"] . '</td>';
				$tbl .= '<td style="border:1px solid #000;text-align:center">' . $jumlah_penumpang_total->row()->jumlah_penumpang . '</td>';
				$tbl .= '<td style="border:1px solid #000;text-align:center">' . $ketersediaan_bus_total->row()->jumlah_bus . '</td>';
				$tbl .= '<td style="border:1px solid #000;text-align:center">' . $jumlah_fasilitas_total->row()->jumlah_fasilitas . '</td></tr>';
				//$tbl .= '<td style="border:1px solid #000;text-align:center">' . $pp["ketersediaan_bus_total"] . '</td>';
				//$tbl .= '<td style="border:1px solid #000;text-align:center">' . $pp["jumlah_fasilitas_total"] . '</td></tr>';
			}

			$tbl_footer = "</table>";


			$pdf->writeHTML($tbl_header . $tbl . $tbl_footer, true, false, false, false, '');
			$pdf->Output('cetak_loket.pdf', 'I');

			//pdf
		}
	}




	function logout()
	{
		$this->session->sess_destroy();
		redirect('');
	}
}
