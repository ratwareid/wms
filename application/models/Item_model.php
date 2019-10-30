<?php

class Item_model extends CI_Model {

//    nama tabel dan primary key
    private $table = 'm_item';
    private $pk = 'id_barang';

//    tampilkan semua data
    public function tampilkanSemua() {
        $q = $this->db->order_by($this->pk);
        $q = $this->db->get($this->table);
        return $q;
    }
	
	public function getlist_paging($limit, $start){
        $q = $this->db->get($this->table, $limit, $start);
        return $q;
    }

    public function getById($id_barang) {
        $q = $this->db->where($this->pk,$id_barang);
        $q = $this->db->get($this->table);
        return $q;
    }

    public function tambah($data) {
        $this->db->insert($this->table, $data);
    }

    public function ubah($id_barang,$data) {

        $this->db->where($this->pk, $id_barang);
        $this->db->update($this->table, $data);
    }

    public function hapus($id_barang) {
        $this->db->where($this->pk, $id_barang);
        $this->db->delete($this->table);
    }
	public function get_product_keyword($keyword,$limit,$start){
		$q = $this->db->select('*');
		$q = $this->db->like('kode_barang',$keyword);
		$q = $this->db->or_like('nama_barang',$keyword);
		$q = $this->db->or_like('jenis_barang',$keyword);
		$q = $this->db->or_like('satuan',$keyword);
		$q = $this->db->or_like('stock',$keyword);
		$q = $this->db->get($this->table,$limit,$start);
		return $q;
	}

}
