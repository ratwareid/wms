<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

        function __construct()
        {
            parent::__construct();
//            jika belum login redirect ke login
            if ($this->session->userdata('logged')<>1) {
                redirect(site_url('auth'));
            }
			$this->load->library('pagination');//load libary pagination
            $this->load->model('user_model');
        }


	public function index()
	{

            $config['base_url'] = site_url('user/index'); //site url
			$config['total_rows'] = $this->db->count_all('m_user'); //total row
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
			$data['rows'] = $this->user_model->getlist_paging($config["per_page"], $data['page'])->result();
			$data['pagination'] = $this->pagination->create_links();
			$data['title'] = 'Ratwareid.com';
			$data['menu'] = 'user';
			$data['judul'] = 'Halaman User';
			$data['content'] = 'user/content';
			
			$data['pagename'] = 'Data Pengguna';
			$data['searchlink'] = 'user/search';
			$data['system'] = 'WMS';

            $this->load->view('user',$data);
	}

        public function create() {
            $data = array(
                'title' => 'Ratwareid.com',
				'menu' => 'user',
                'heading' => 'User / Add New User',
                'action' => base_url().'user/docreate',
                'content' => 'user/form-input',
				'system' => 'WMS',
				'userid' => '',
                'username' => '',
				'fullname' => '',
				'email' => '',
                'password' => '',
				'error' => '',
				'pagename' => 'Data Pengguna'
            );

            $this->load->view('user',$data);
        }

        public function docreate() {

//            warning : aksi ini tanpa ada validasi form
            $data = array(
                'username' => $this->input->post('username'),
				'fullname' => $this->input->post('fullname'),
				'email' => $this->input->post('email'),
                'password' => md5($this->input->post('password'))
            );

            $this->load->model('user_model');
            $this->user_model->tambah($data);

            redirect(base_url().'user');
        }

        public function edit($userid) {

            $this->load->model('user_model');
            $row = $this->user_model->getById($userid)->row();

            $data = array(
                'title' => 'Ratwareid.com',
                'menu' => 'company',
                'heading' => 'Edit Company',
				'error' => '',
				'system' => 'WMS',
                'action' => base_url().'user/doedit',
                'content' => 'user/form-input',
                'username' => $row->username,
				'fullname' => $row->fullname,
				'email' => $row->email,
                'password' => '',
                'userid' => $row->userid,
				'pagename' => 'Data Pengguna'
            );

            $this->load->view('user',$data);
        }

        public function doedit() {
//            warning : aksi ini tanpa ada validasi form
            $updatepassword = array(
				'username' => $this->input->post('username'),
                'fullname' => $this->input->post('fullname'),
				'email' => $this->input->post('email'),
                'password' => md5($this->input->post('password'))
            );

            $tidakupdatepassword = array(
			'username' => $this->input->post('username'),
                'fullname' => $this->input->post('fullname'),
				'email' => $this->input->post('email'),
                'username' => $this->input->post('username'),
            );

            $data = trim($this->input->post('password'))<>''?$updatepassword:$tidakupdatepassword;

            $this->load->model('user_model');
            $this->user_model->ubah($this->input->post('userid'),$data);

            redirect(base_url().'user');
        }

        public function delete($userid) {
            $this->user_model->hapus($userid);

            redirect(base_url().'user');
        }
		
		public function search(){
			
			
		$config['base_url'] = site_url('user/index'); //site url
        $config['total_rows'] = $this->db->count_all('m_user'); //total row
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
			$data['rows']=$this->user_model->get_product_keyword($keyword,$config["per_page"], $data['page'])->result();
			$data['pagename'] = 'Data Pengguna';
			$data['searchlink'] = 'user/search';
			$data['content'] = 'user/content';
			$data['menu'] = 'user';
			$data['system'] = 'WMS';
			$data['pagination'] = $this->pagination->create_links();
			
			$this->load->view('user',$data);
		}
}

/* End of file user.php */
/* Location: ./application/controllers/user.php */
