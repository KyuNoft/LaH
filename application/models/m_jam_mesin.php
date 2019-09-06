<?php
class m_jam_mesin extends ci_model{

	public function GetDataNamaProduk(){
		$this->db->select('b.nama_produk');
		$this->db->from('jam_mesin a');
		$this->db->join('produk b', 'a.kd_produk = b.kd_produk');
		$this->db->group_by('b.nama_produk');
		return $this->db->get()->result();
	}

	public function Get(){
		$this->db->select('a.nama_produk, b.nama_mesin, b.satuan, c.waktu');
		$this->db->from('produk a');
		$this->db->join('jam_mesin c', 'a.kd_produk = c.kd_produk');
		$this->db->join('mesin b', 'c.kd_mesin = b.kd_mesin');
		$this->db->where('a.nama_produk', $this->input->post('nama_produk'));
		return $this->db->get()->result();
	}

	public function GetDetail($kd, $nama){
		$this->db->select('a.kd_produk, a.nama_produk, b.kd_mesin, b.nama_mesin, b.satuan, c.waktu');
		$this->db->from('produk a');
		$this->db->join('jam_mesin c', 'a.kd_produk = c.kd_produk');
		$this->db->join('mesin b', 'c.kd_mesin = b.kd_mesin');
		$this->db->where('a.kd_produk', $kd);
		$this->db->or_where('a.nama_produk', $nama);
		return $this->db->get()->result();
	}

	public function GetJumlah($kd, $nama){
		$this->db->select('a.kd_produk, a.nama_produk, b.kd_mesin, b.nama_mesin, b.satuan, c.waktu');
		$this->db->from('produk a');
		$this->db->join('jam_mesin c', 'a.kd_produk = c.kd_produk');
		$this->db->join('mesin b', 'c.kd_mesin = b.kd_mesin');
		$this->db->where('a.kd_produk', $kd);
		$this->db->or_where('a.nama_produk', $nama);
		return $this->db->get()->num_rows();
	}

	public function Simpan(){
		$data = array(
			'kd_produk' => $this->input->post('kd_produk'),
			'kd_mesin'  => $this->input->post('kd_mesin'),
			'waktu' 	=> $this->input->post('waktu'),
			'status'   	=> 'Belum',
		);
		$this->db->insert('jam_mesin', $data);
	}

	public function Selesai($kd){
		$this->db->set('status', 'Selesai');
		$this->db->where('kd_produk', $kd);
		$this->db->update('jam_mesin');
	}
	
	public function Hapus($kdp, $kdbh){
		$this->db->where('kd_produk', $kdp);
		$this->db->where('kd_mesin', $kdbh);
		$this->db->delete('jam_mesin');
	}
}