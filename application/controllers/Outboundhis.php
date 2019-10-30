<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Outboundhis extends CI_Controller {

        function __construct()
        {
            parent::__construct();
//            jika belum login redirect ke login
            if ($this->session->userdata('logged')<>1) {
                redirect(site_url('auth'));
            }
			if( ! ini_get('date.timezone') ){
				date_default_timezone_set("Asia/Bangkok");
			}
			$this->load->library('pagination');//load libary pagination
			$this->load->library('pdf');
			$this->load->model('outbound_model');
        }


	public function index(){
		$data['menu'] = 'outboundhis';
		$data['pagename'] = 'Laporan Barang Keluar';
		$data['action'] = 'outboundhis/cetakpdf';
		$data['heading'] = 'Cetak Laporan Barang Keluar';
		$data['content'] = 'outbound/content';
		$data['error'] = '';
		$data['datepicker2'] = '';
		$data['datepicker3'] = '';
		$data['listbarang'] = $this->outbound_model->getBarang();
		$this->load->view('outboundhis',$data);
    }
	
	public function cetakpdf(){
		
		
        $pdf = new FPDF('l','mm','A5');
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial','B',16);
        // mencetak string 
        $pdf->Cell(190,7,'Laporan Barang Keluar PT. Cakra Sanjaya Acs',0,1,'C');
         
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(30,7,'',0,1);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(60,6,'Tanggal Keluar',1,0);
        $pdf->Cell(90,6,'Nama Barang',1,0);
        $pdf->Cell(35,6,'Qty',1,1);
		
        $pdf->SetFont('Arial','',10);
		$datefrom = $this->input->post('datepicker2');
		$dateto = $this->input->post('datepicker3');
		if ($datefrom != null){	
			$d1f = DateTime::createFromFormat('d/m/Y', $datefrom);
			$datefrom = $d1f->format('Y/m/d');
		}
		if ($dateto != null){	
			$d2f = DateTime::createFromFormat('d/m/Y', $dateto);
			$dateto = $d2f->format('Y/m/d');
		}
		$idbarang = $this->input->post('id_barang');
		
        $rows = $this->outbound_model->getlist_print($datefrom,$dateto,$idbarang)->result();
        foreach ($rows as $row){
			$date = $row->tgl_outbound;
			$newDate = date("d-m-Y", strtotime($date));
            $pdf->Cell(60,6,$newDate,1,0);
            $pdf->Cell(90,6,$row->nama_barang,1,0);
            $pdf->Cell(35,6,number_format( $row->qty_barang, 0 ),1,1);
        }
        $pdf->Output();
    }
}

/* End of file user.php */
/* Location: ./application/controllers/user.php */
