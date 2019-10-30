<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inbound extends CI_Controller {

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
            $this->load->model('inbound_model');
        }


	public function index()
	{
			$error = array(
                'errorcode' =>'',
				'errormsg' => '',
            );
            $this->session->set_userdata($error);

            $config['base_url'] = site_url('inbound/index'); //site url
			$config['total_rows'] = $this->db->count_all('t_inbound'); //total row
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
	 
			//panggil function get_mahasiswa_list yang ada pada mmodel mahasiswa_model. 
			$data['rows'] = $this->inbound_model->getlist_paging($config["per_page"], $data['page'])->result();
			$data['pagination'] = $this->pagination->create_links();
			$data['title'] = 'Ratwareid.com';
			$data['menu'] = 'inbound';
			$data['judul'] = 'Transaksi Barang Masuk';
			$data['content'] = 'inbound/content';
			$data['pagename'] = 'Data Barang Masuk';
			$data['searchlink'] = 'inbound/search';
			$data['system'] = 'WMS';

            $this->load->view('inbound',$data);
	}

        public function create() {
            $data = array(
                'title' => 'Ratwareid.com',
				'menu' => 'inbound',
                'heading' => 'Inbound / Add New Inbound Item',
                'action' => base_url().'inbound/docreate',
                'content' => 'inbound/form-input',
				'system' => 'WMS',
				'id_inbound' => '',
                'tgl_inbound' => '',
				'id_barang' => '',
				'qty_barang' => '',
                'creator' => '',
				'error' => '',
				'listbarang' => $this->inbound_model->getBarang(),
				'inc' => '0',
				'pagename' => 'Data Barang Masuk'
            );

            $this->load->view('inbound',$data);
        }

        public function docreate() {	
		
			$newDate = DateTime::createFromFormat('d/m/Y', $this->input->post('tgl_inbound'));
			$rowd = $newDate->format('Y/m/d');
            $data = array(
                'id_inbound' => $this->input->post('id_inbound'),
				'tgl_inbound' => $rowd,
				'id_barang' => $this->input->post('id_barang'),
                'qty_barang' => $this->input->post('qty_barang'),
				'creator' => $this->input->post('creator')
            );

            $this->load->model('inbound_model');
            $this->inbound_model->tambah($data);

            redirect(base_url().'inbound');
        }

        public function edit($id_inbound) {

            $this->load->model('inbound_model');
            $row = $this->inbound_model->getById($id_inbound)->row();

			
			$date = $row->tgl_inbound;
			$newDate = date("d-m-Y", strtotime($date));
			
			$empty = '';
            $data = array(
                'title' => 'Ratwareid.com',
                'menu' => 'inbound',
                'heading' => 'Edit Inbound Item',
				'error' => '',
				'system' => 'WMS',
                'action' => base_url().'inbound/doedit',
                'content' => 'inbound/form-input',
				'id_inbound' => $row->id_inbound,
				'tgl_inbound' => $newDate,
				'id_barang' => $row->id_barang,
				'nama_barang' => $row->nama_barang,
                'qty_barang' => $row->qty_barang,
				'creator' => $row->creator,
				'pagename' => 'Data Barang Masuk',
				'errormsg' => '',
				'listbarang' => $this->inbound_model->getBarang()
            );

            $this->load->view('inbound',$data);
        }

        public function doedit() {
			
			$newDate = DateTime::createFromFormat('d/m/Y', $this->input->post('tgl_inbound'));
			$rowd = $newDate->format('Y/m/d');
			
			$data = array(
                'id_inbound' => $this->input->post('id_inbound'),
				'tgl_inbound' => $rowd,
				'id_barang' => $this->input->post('id_barang'),
                'qty_barang' => $this->input->post('qty_barang'),
				'creator' => $this->input->post('creator')
            );

            $this->load->model('inbound_model');
            $this->inbound_model->ubah($this->input->post('id_inbound'),$data);
	
				if ($this->session->userdata['errormsg'] != null){
					$data['errormsg'] = $this->session->userdata['errormsg'];
					$data['content'] = 'inbound/form-edit';
					$data['menu'] = 'inbound';
					redirect(base_url().'inbound/edit/'.$this->input->post('id_inbound'));	
				}else{
					redirect(base_url().'inbound');	
				}
        }

        public function delete($id_inbound) {
            $this->load->model('inbound_model');
            $row = $this->inbound_model->getById($id_inbound)->row();
			
			$date = $row->tgl_inbound;
			$newDate = date("d-m-Y", strtotime($date));
			
			$empty = '';
            $data = array(
                'title' => 'Ratwareid.com',
                'menu' => 'inbound',
                'heading' => 'Delete Inbound Item',
				'error' => '',
				'system' => 'WMS',
                'action' => base_url().'inbound/dodelete',
                'content' => 'inbound/form-delete',
				'id_inbound' => $row->id_inbound,
				'tgl_inbound' => $newDate,
				'id_barang' => $row->id_barang,
				'nama_barang' => $row->nama_barang,
                'qty_barang' => $row->qty_barang,
				'creator' => $row->creator,
				'pagename' => 'Data Barang Masuk',
				'errormsg' => '',
				'listbarang' => $this->inbound_model->getBarang()
            );

            $this->load->view('inbound',$data);
        }
		
		public function dodelete() {
				$this->inbound_model->hapus($this->input->post('id_inbound'));
				if ($this->session->userdata['errormsg'] != null){
					$data['errormsg'] = $this->session->userdata['errormsg'];
					$data['content'] = 'inbound/form-error';
					$data['menu'] = 'inbound';
					redirect(base_url().'inbound/delete/'.$this->input->post('id_inbound'));	
				}else{
					redirect(base_url().'inbound');	
				}
        }
		
		public function search(){
			
			
			$config['base_url'] = site_url('inbound/index'); //site url
			$config['total_rows'] = $this->db->count_all('t_inbound'); //total row
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
			$data['rows']=$this->inbound_model->get_product_keyword($keyword,$config["per_page"], $data['page'])->result();
			$data['pagename'] = 'Data Barang Masuk';
			$data['searchlink'] = 'inbound/search';
			$data['content'] = 'inbound/content';
			$data['menu'] = 'inbound';
			$data['system'] = 'WMS';
			$data['pagination'] = $this->pagination->create_links();
			
			$this->load->view('inbound',$data);
		}
		
		public function adddetail($inc){
			
			$inc++;
			$data = array(
                'title' => 'Ratwareid.com',
				'menu' => 'inbound',
                'heading' => 'Inbound / Add New Inbound Item',
                'action' => base_url().'inbound/docreate',
                'content' => 'inbound/form-input',
				'system' => 'WMS',
				'id_inbound' => '',
                'tgl_inbound' => '',
				'id_barang' => '',
				'qty_barang' => '',
                'creator' => '',
				'error' => '',
				'pagename' => 'Data Barang Masuk',
				'listbarang' => $this->inbound_model->getBarang(),
				'inc' => $inc
            );
			$this->load->view('inbound',$data);
		}
		
}
