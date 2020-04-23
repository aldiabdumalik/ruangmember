<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Style;

class Report extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('username')) {
            redirect('goadmin','refresh');
        }
	}

	public function index()
	{
		$data['admin'] = $this->global->get_admin([
			'id_user' => $this->session->userdata('id_user')
		]);
		$data['title']  = 'Report';
	    $data['js']   = 'report';
	    $this->template->load('template', 'mod/report/view_index', $data);
	}

	public function cetak_excel()
	{
		$sekarang = $this->__convert_bulan(date('m'));
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$bln = $this->__convert_bulan($bulan);
		if (empty($bulan)) {
			$where = array(
				'order_id.order_status' => 'selesai',
				'YEAR(order_id.tgl_order)' => $this->input->post('tahun')
			);
			$title = "Report Transaksi Pertahun ${tahun} sampai dengan Bulan Sekarang (${sekarang})";
		}else{
			$where = array(
				'order_id.order_status' => 'selesai',
				'YEAR(order_id.tgl_order)' => $this->input->post('tahun'),
				'MONTH(order_id.tgl_order)' => $this->input->post('bulan')
			);
			$title = "Report Transaksi Perbulan ${bln} tahun ${tahun}";
		}
		$result = $this->report->get_report($where);
		print_r($result);
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->setCellValue('A1', $title);
		$sheet->mergeCells('A1:G1');
		$styleArray = [
			'font' => [
				'bold' => true,
			],
			'alignment' => [
	            'horizontal' => PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
	        ],
		];
		$sheet->getStyle('A1:G1')->applyFromArray($styleArray);

		// array result
		$sheet->setCellValue('A2', 'No');
		$sheet->setCellValue('B2', 'ID Order');
		$sheet->setCellValue('C2', 'Distributor');
		$sheet->setCellValue('D2', 'Consumer');
		// $sheet->setCellValue('E2', 'No WA');
		$sheet->setCellValue('E2', 'Alamat');
		$sheet->setCellValue('F2', 'Total Order');
		$sheet->setCellValue('G2', 'Tanggal');
		$styleArray = [
			'font' => [
				'bold' => true,
			]
		];
		$sheet->getStyle('A2:H2')->applyFromArray($styleArray);

		$no = 1;
		$i = 3;
		foreach ($result as $key => $v) {
			$sheet->setCellValue('A'.$i, $no);
			$sheet->setCellValue('B'.$i, $v['id_order']);
			$sheet->setCellValue('C'.$i, $v['nama_sales']);
			$sheet->setCellValue('D'.$i, $v['nama_penerima']);
			// $sheet->setCellValue('E'.$i, strval($v['nowa_penerima']));
			$sheet->setCellValue('E'.$i, $v['order_alamat']);
			$sheet->setCellValue('F'.$i, $v['total_order']);
			$sheet->setCellValue('G'.$i, date('d/m/Y', strtotime($v['tgl_order'])));
			$no++;
			$i++;
		}
		$writer = new Xlsx($spreadsheet);
		ob_end_clean();
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="report.xlsx"'); 
		header('Cache-Control: max-age=0');
		$writer->save('php://output');
	}

	function __convert_bulan($bulan)
	{
		switch ($bulan) {
			case '01':
				$bulan = 'Januari';
				break;
			case '02':
				$bulan = 'Februari';
				break;
			case '03':
				$bulan = 'Maret';
				break;
			case '04':
				$bulan = 'April';
				break;
			case '05':
				$bulan = 'Mei';
				break;
			case '06':
				$bulan = 'Juni';
				break;
			case '07':
				$bulan = 'Juli';
				break;
			case '08':
				$bulan = 'Agustus';
				break;
			case '09':
				$bulan = 'September';
				break;
			case '10':
				$bulan = 'Oktober';
				break;
			case '11':
				$bulan = 'November';
				break;
			case '12':
				$bulan = 'Desember';
				break;
			default:
				$bulan = date('M');
				break;
		}
		return $bulan;
	}

}

/* End of file Report.php */
/* Location: ./application/controllers/Report.php */