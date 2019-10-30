<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Item extends CI_Controller {

        function __construct()
        {
            parent::__construct();
//            jika belum login redirect ke login
            if ($this->session->userdata('logged')<>1) {
                redirect(site_url('auth'));
            }
			$this->load->library('pagination');//load libary pagination
            $this->load->model('item_model');
        }


	public function index()
	{

            $config['base_url'] = site_url('item/index'); //site url
			$config['total_rows'] = $this->db->count_all('m_item'); //total row
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
			$data['rows'] = $this->item_model->getlist_paging($config["per_page"], $data['page'])->result();
			$data['pagination'] = $this->pagination->create_links();
			$data['title'] = 'Ratwareid.com';
			$data['menu'] = 'item';
			$data['content'] = 'item/content';
			
			$data['pagename'] = 'Data Barang';
			$data['searchlink'] = 'item/search';
			$data['system'] = 'WMS';

            $this->load->view('item',$data);
	}

        public function create() {
            $data = array(
                'title' => 'Ratwareid.com',
				'menu' => 'item',
                'heading' => 'item / Add New item',
                'action' => base_url().'item/docreate',
                'content' => 'item/form-input',
				'system' => 'WMS',
				'id_barang' => '',
                'kode_barang' => '',
				'nama_barang' => '',
				'jenis_barang' => '',
                'satuan' => '',
				'stock' => '',
				'error' => '',
				'pagename' => 'Data Barang'
            );

            $this->load->view('item',$data);
        }

        public function docreate() {

//            warning : aksi ini tanpa ada validasi form
            $data = array(
                'kode_barang' => $this->input->post('kode_barang'),
				'nama_barang' => $this->input->post('nama_barang'),
				'jenis_barang' => $this->input->post('jenis_barang'),
                'satuan' => $this->input->post('satuan'),
				'stock' => $this->input->post('stock')
            );

            $this->load->model('item_model');
            $this->item_model->tambah($data);

            redirect(base_url().'item');
        }

        public function edit($itemid) {

            $this->load->model('item_model');
            $row = $this->item_model->getById($itemid)->row();

            $data = array(
                'title' => 'Ratwareid.com',
                'menu' => 'company',
                'heading' => 'Edit Company',
				'error' => '',
				'system' => 'WMS',
                'action' => base_url().'item/doedit',
                'content' => 'item/form-input',
				'id_barang' => $row->id_barang,
                'kode_barang' => $row->kode_barang,
				'nama_barang' => $row->nama_barang,
				'jenis_barang' => $row->jenis_barang,
                'satuan' => $row->satuan,
				'stock' => $row->stock,
				'pagename' => 'Data Barang'
            );

            $this->load->view('item',$data);
        }

        public function doedit() {
			$data = array(
				'id_barang' => $this->input->post('id_barang'),
                'kode_barang' => $this->input->post('kode_barang'),
				'nama_barang' => $this->input->post('nama_barang'),
				'jenis_barang' => $this->input->post('jenis_barang'),
                'satuan' => $this->input->post('satuan'),
				'stock' => $this->input->post('stock')
            );

            $this->load->model('item_model');
            $this->item_model->ubah($this->input->post('id_barang'),$data);

            redirect(base_url().'item');
        }

        public function delete($id_barang) {
            $this->item_model->hapus($id_barang);

            redirect(base_url().'item');
        }
		
		public function search(){
			
			
		$config['base_url'] = site_url('item/index'); //site url
        $config['total_rows'] = $this->db->count_all('m_item'); //total row
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
			$data['rows']=$this->item_model->get_product_keyword($keyword,$config["per_page"], $data['page'])->result();
			$data['pagename'] = 'Data Barang';
			$data['searchlink'] = 'item/search';
			$data['content'] = 'item/content';
			$data['menu'] = 'item';
			$data['system'] = 'WMS';
			$data['pagination'] = $this->pagination->create_links();
			
			$this->load->view('item',$data);
		}
}

/* End of file item.php */
/* Location: ./application/controllers/item.php */
