<?php
class m_bom extends ci_model{

	public function GetDataNamaProduk(){
		$this->db->select('b.nama_produk');
		$this->db->from('bom a');
		$this->db->join('produk b', 'a.kd_produk = b.kd_produk');
		$this->db->group_by('b.nama_produk');
		return $this->db->get()->result();
	}

	public function Get(){
		$this->db->select('a.nama_produk, b.nama_bahan_baku, b.jenis_bahan_baku, b.satuan, c.kuantitas');
		$this->db->from('produk a');
		$this->db->join('bom c', 'a.kd_produk = c.kd_produk');
		$this->db->join('bahan_baku b', 'c.kd_bahan_baku = b.kd_bahan_baku');
		$this->db->where('a.nama_produk', $this->input->post('nama_produk'));
		return $this->db->get()->result();
	}

	public function GetDetail($kd, $nama){
		$this->db->select('a.kd_produk, a.nama_produk, b.kd_bahan_baku, b.nama_bahan_baku, b.satuan, c.kuantitas');
		$this->db->from('produk a');
		$this->db->join('bom c', 'a.kd_produk = c.kd_produk');
		$this->db->join('bahan_baku b', 'c.kd_bahan_baku = b.kd_bahan_baku');
		$this->db->where('a.kd_produk', $kd);
		$this->db->or_where('a.nama_produk', $nama);
		return $this->db->get()->result();
	}

	public function GetJumlah($kd, $nama){
		$this->db->select('a.kd_produk, a.nama_produk, b.kd_bahan_baku, b.nama_bahan_baku, b.satuan, c.kuantitas');
		$this->db->from('produk a');
		$this->db->join('bom c', 'a.kd_produk = c.kd_produk');
		$this->db->join('bahan_baku b', 'c.kd_bahan_baku = b.kd_bahan_baku');
		$this->db->where('a.kd_produk', $kd);
		$this->db->or_where('a.nama_produk', $nama);
		return $this->db->get()->num_rows();
	}

	public function Simpan(){
		$data = array(
			'kd_produk'     => $this->input->post('kd_produk'),
			'kd_bahan_baku' => $this->input->post('kd_bahan_baku'),
			'kuantitas'     => $this->input->post('kuantitas'),
			'status'   		=> 'Belum',
		);
		$this->db->insert('bom', $data);
	}

	public function Selesai($kd){
		$this->db->set('status', 'Selesai');
		$this->db->where('kd_produk', $kd);
		$this->db->update('bom');
	}
	
	public function Hapus($kdp, $kdbh){
		$this->db->where('kd_produk', $kdp);
		$this->db->where('kd_bahan_baku', $kdbh);
		$this->db->delete('bom');
	}
}