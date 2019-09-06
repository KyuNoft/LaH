<?php
class m_routing extends ci_model{

	public function GetDataNamaProduk(){
		$this->db->select('b.nama_produk');
		$this->db->from('routing a');
		$this->db->join('produk b', 'a.kd_produk = b.kd_produk');
		$this->db->group_by('b.nama_produk');
		return $this->db->get()->result();
	}

	public function Get(){
		$this->db->select('a.nama_produk, b.nama_aktivitas, b.satuan, c.waktu');
		$this->db->from('produk a');
		$this->db->join('routing c', 'a.kd_produk = c.kd_produk');
		$this->db->join('aktivitas b', 'c.kd_aktivitas = b.kd_aktivitas');
		$this->db->where('a.nama_produk', $this->input->post('nama_produk'));
		return $this->db->get()->result();
	}

	public function GetDetail($kd, $nama){
		$this->db->select('a.kd_produk, a.nama_produk, b.kd_aktivitas, b.nama_aktivitas, b.satuan, c.waktu');
		$this->db->from('routing c');
		$this->db->join('produk a', 'a.kd_produk = c.kd_produk');
		$this->db->join('aktivitas b', 'c.kd_aktivitas = b.kd_aktivitas');
		$this->db->where('a.kd_produk', $kd);
		$this->db->or_where('a.nama_produk', $nama);
		return $this->db->get()->result();
	}

	public function GetJumlah($kd, $nama){
		$this->db->select('a.kd_produk, a.nama_produk, b.kd_aktivitas, b.nama_aktivitas, b.satuan, c.waktu');
		$this->db->from('routing c');
		$this->db->join('produk a', 'a.kd_produk = c.kd_produk');
		$this->db->join('aktivitas b', 'c.kd_aktivitas = b.kd_aktivitas');
		$this->db->where('a.kd_produk', $kd);
		$this->db->or_where('a.nama_produk', $nama);
		return $this->db->get()->num_rows();
	}

	public function Simpan(){
		$data = array(
			'kd_produk'    => $this->input->post('kd_produk'),
			'kd_aktivitas' => $this->input->post('kd_aktivitas'),
			'waktu'        => $this->input->post('waktu'),
			'status'       => 'Belum',
		);
		$this->db->insert('routing', $data);
	}

	public function Selesai($kd){
		$this->db->set('status', 'Selesai');
		$this->db->where('kd_produk', $kd);
		$this->db->update('routing');
	}
	
	public function Hapus($kdp, $kdbh){
		$this->db->where('kd_produk', $kdp);
		$this->db->where('kd_aktivitas', $kdbh);
		$this->db->delete('routing');
	}
}