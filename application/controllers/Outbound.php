<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Outbound extends CI_Controller {

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
            $this->load->model('outbound_model');
        }


	public function index()
	{
			$error = array(
                'errorcode' =>'',
				'errormsg' => '',
            );
            $this->session->set_userdata($error);
            $config['base_url'] = site_url('outbound/index'); //site url
			$config['total_rows'] = $this->db->count_all('t_outbound'); //total row
			$config['per_page'] = 10;  //show record per halaman
			$config["uri_segment"] = 3;  // uri parameter
			$choice = $config["total_rows"] / $config["per_page"];
			$config["num_links"] = floor($choice);
	 
			// Membuat Style pagination untuk BootStrap v4
			$config['first_link']       = 'First';
			$config['last_link']        = 'Last';
			$config['next_link']        = 'Next';
			$config['prev_link']        = 'Prev';
			$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
			$config['full_tag_close']   = '</ul></nav></div>';
			$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
			$config['num_tag_close']    = '</span></li>';
			$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
			$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
			$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
			$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
			$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
			$config['prev_tagl_close']  = '</span>Next</li>';
			$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
			$config['first_tagl_close'] = '</span></li>';
			$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
			$config['last_tagl_close']  = '</span></li>';
	 
			$this->pagination->initialize($config);
			$data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
	 
			$data['rows'] = $this->outbound_model->getlist_paging($config["per_page"], $data['page'])->result();
			$data['pagination'] = $this->pagination->create_links();
			$data['title'] = 'Ratwareid.com';
			$data['menu'] = 'outbound';
			$data['judul'] = 'Transaksi Barang Keluar';
			$data['content'] = 'outbound/content';
			
			$data['pagename'] = 'Data Barang Keluar';
			$data['searchlink'] = 'outbound/search';
			$data['system'] = 'WMS';

            $this->load->view('outbound',$data);
	}

        public function create() {
            $data = array(
                'title' => 'Ratwareid.com',
				'menu' => 'outbound',
                'heading' => 'Outbound / Add New Outbound Item',
                'action' => base_url().'outbound/docreate',
                'content' => 'outbound/form-input',
				'system' => 'WMS',
				'id_outbound' => '',
                'tgl_outbound' => '',
				'id_barang' => '',
				'qty_barang' => '',
                'creator' => '',
				'error' => '',
				'listbarang' => $this->outbound_model->getBarang(),
				'inc' => '0',
				'pagename' => 'Data Barang Keluar'
            );

            $this->load->view('outbound',$data);
        }

        public function docreate() {	
		
			$newDate = DateTime::createFromFormat('d/m/Y', $this->input->post('tgl_outbound'));
			$rowd = $newDate->format('Y/m/d');
            $data = array(
                'id_outbound' => $this->input->post('id_outbound'),
				'tgl_outbound' => $rowd,
				'id_barang' => $this->input->post('id_barang'),
                'qty_barang' => $this->input->post('qty_barang'),
				'creator' => $this->input->post('creator')
            );

            $this->load->model('outbound_model');
            $this->outbound_model->tambah($data);

            redirect(base_url().'outbound');
        }

        public function edit($id_outbound) {

            $this->load->model('outbound_model');
            $row = $this->outbound_model->getById($id_outbound)->row();
			
			$date = $row->tgl_outbound;
			$newDate = date("d-m-Y", strtotime($date));
			
            $data = array(
                'title' => 'Ratwareid.com',
                'menu' => 'outbound',
                'heading' => 'Edit Outbound Item',
				'error' => '',
				'system' => 'WMS',
                'action' => base_url().'outbound/doedit',
                'content' => 'outbound/form-input',
				'id_outbound' => $row->id_outbound,
				'tgl_outbound' => $newDate,
				'id_barang' => $row->id_barang,
				'nama_barang' => $row->nama_barang,
                'qty_barang' => $row->qty_barang,
				'creator' => $row->creator,
				'pagename' => 'Data Barang Keluar',
				'listbarang' => $this->outbound_model->getBarang()
            );

            $this->load->view('outbound',$data);
        }

        public function doedit() {

			$newDate = DateTime::createFromFormat('d/m/Y', $this->input->post('tgl_outbound'));
			$rowd = $newDate->format('Y/m/d');
			$data = array(
                'id_outbound' => $this->input->post('id_outbound'),
				'tgl_outbound' => $rowd ,
				'id_barang' => $this->input->post('id_barang'),
                'qty_barang' => $this->input->post('qty_barang'),
				'creator' => $this->input->post('creator')
            );

            $this->load->model('outbound_model');
            $this->outbound_model->ubah($this->input->post('id_outbound'),$data);

            if ($this->session->userdata['errormsg'] != null){
					$data['errormsg'] = $this->session->userdata['errormsg'];
					$data['content'] = 'outbound/form-edit';
					$data['menu'] = 'outbound';
					redirect(base_url().'outbound/edit/'.$this->input->post('id_outbound'));	
				}else{
					redirect(base_url().'outbound');	
				}
        }

        public function delete($id_outbound) {
            $this->load->model('outbound_model');
            $row = $this->outbound_model->getById($id_outbound)->row();
			
			$date = $row->tgl_outbound;
			$newDate = date("d-m-Y", strtotime($date));
			
			$empty = '';
            $data = array(
                'title' => 'Ratwareid.com',
                'menu' => 'outbound',
                'heading' => 'Delete Outbound Item',
				'error' => '',
				'system' => 'WMS',
                'action' => base_url().'outbound/dodelete',
                'content' => 'outbound/form-delete',
				'id_outbound' => $row->id_outbound,
				'tgl_outbound' => $newDate,
				'id_barang' => $row->id_barang,
				'nama_barang' => $row->nama_barang,
                'qty_barang' => $row->qty_barang,
				'creator' => $row->creator,
				'pagename' => 'Data Barang Masuk',
				'errormsg' => '',
				'listbarang' => $this->outbound_model->getBarang()
            );

            $this->load->view('outbound',$data);
        }
		
		public function dodelete() {
				$this->outbound_model->hapus($this->input->post('id_outbound'));
				if ($this->session->userdata['errormsg'] != null){
					$data['errormsg'] = $this->session->userdata['errormsg'];
					$data['content'] = 'outbound/form-error';
					$data['menu'] = 'outbound';
					redirect(base_url().'outbound/delete/'.$this->input->post('id_outbound'));	
				}else{
					redirect(base_url().'outbound');	
				}
        }
		
		public function search(){
			
			
			$config['base_url'] = site_url('outbound/index'); //site url
			$config['total_rows'] = $this->db->count_all('t_outbound'); //total row
			$config['per_page'] = 10;  //show record per halaman
			$config["uri_segment"] = 3;  // uri parameter
			$choice = $config["total_rows"] / $config["per_page"];
			$config["num_links"] = floor($choice);
	 
			// Membuat Style pagination untuk BootStrap v4
			$config['first_link']       = 'First';
			$config['last_link']        = 'Last';
			$config['next_link']        = 'Next';
			$config['prev_link']        = 'Prev';
			$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
			$config['full_tag_close']   = '</ul></nav></div>';
			$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
			$config['num_tag_close']    = '</span></li>';
			$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
			$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
			$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
			$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
			$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
			$config['prev_tagl_close']  = '</span>Next</li>';
			$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
			$config['first_tagl_close'] = '</span></li>';
			$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
			$config['last_tagl_close']  = '</span></li>';
	 
			$this->pagination->initialize($config);
			$data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
			
			$keyword = $this->input->post('keyword');
			$data['rows']=$this->outbound_model->get_product_keyword($keyword,$config["per_page"], $data['page'])->result();
			$data['pagename'] = 'Data Barang Keluar';
			$data['searchlink'] = 'outbound/search';
			$data['content'] = 'outbound/content';
			$data['menu'] = 'outbound';
			$data['system'] = 'WMS';
			$data['pagination'] = $this->pagination->create_links();
			
			$this->load->view('outbound',$data);
		}
		
		public function adddetail($inc){
			
			$inc++;
			$data = array(
                'title' => 'Ratwareid.com',
				'menu' => 'outbound',
                'heading' => 'Outbound / Add New Outbound Item',
                'action' => base_url().'outbound/docreate',
                'content' => 'outbound/form-input',
				'system' => 'WMS',
				'id_outbound' => '',
                'tgl_outbound' => '',
				'id_barang' => '',
				'qty_barang' => '',
                'creator' => '',
				'error' => '',
				'pagename' => 'Data Barang Keluar',
				'listbarang' => $this->outbound_model->getBarang(),
				'inc' => $inc
            );
			$this->load->view('outbound',$data);
		}
		
}
