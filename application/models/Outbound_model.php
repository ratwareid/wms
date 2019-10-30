<?php

class Outbound_model extends CI_Model {

//    nama tabel dan primary key
    private $table = 't_outbound';
    private $pk = 'id_outbound';
	
	public function getlist_paging($limit, $start){
		
		$this->db->select('a.*,b.nama_barang');
		$this->db->join('m_item b', 'a.id_barang = b.id_barang', 'left');
		$q = $this->db->order_by($this->pk);
		$q = $this->db->get('t_outbound a',$limit,$start); 
        return $q;
    }

    public function getById($id_outbound) {
        $q = $this->db->where($this->pk,$id_outbound);
        $q = $this->db->get($this->table);
        return $q;
    }

    public function tambah($data) {
        $this->db->insert($this->table, $data);
    }

    public function ubah($id_outbound,$data) {

        $this->db->where($this->pk, $id_outbound);
        $q = $this->db->update($this->table, $data);
		if( !$q ){
			$errordb = $this->db->error();
			$error = array(
                'errorcode' => $errordb['code'],
				'errormsg' => $errordb['message'],
            );
            $this->session->set_userdata($error);
		   // Do something with the error message or just show_404();
		}
    }

    public function hapus($id_outbound) {
        $this->db->where($this->pk, $id_outbound);
        $q = $this->db->delete($this->table);
		
		if( !$q ){
			$errordb = $this->db->error();
			$error = array(
                'errorcode' => $errordb['code'],
				'errormsg' => $errordb['message']
            );
            $this->session->set_userdata($error);
		   // Do something with the error message or just show_404();
		}
    }
	public function get_product_keyword($keyword,$limit,$start){
		$this->db->select('a.*,b.nama_barang');
		$this->db->join('m_item b', 'a.id_barang = b.id_barang', 'left');
		$this->db->like('a.tgl_outbound',$keyword);
		$this->db->or_like('b.nama_barang',$keyword);
		$this->db->or_like('a.qty_barang',$keyword);
		$q = $this->db->order_by($this->pk);
		$q = $this->db->get('t_outbound a',$limit,$start); 
		return $q;
	}
	
	public function getBarang(){
		$query = $this->db->query('SELECT * FROM m_item');
        return $query->result()
		;
	}

	public function getlist_print($datefrom,$dateto,$idbarang){
		$this->db->select('a.*,b.nama_barang');
		$this->db->join('m_item b', 'a.id_barang = b.id_barang', 'left');
		if ($idbarang != 'all'){
			$this->db->where('a.id_barang', $idbarang);
		}
		if ($datefrom != null){
			$this->db->where('a.tgl_outbound >=', $datefrom);
		}
		if ($dateto != null){
			$this->db->where('a.tgl_outbound <=', $dateto);
		}
		$q = $this->db->order_by('a.tgl_outbound asc');
		$q = $this->db->get('t_outbound a'); 
        return $q;
    }
}
