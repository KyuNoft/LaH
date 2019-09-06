<?php
class m_akun extends ci_model{

	public function Get(){
		$query = $this->db->order_by('no_akun', 'ASC')->get('akun');
		return $query->result();
	}

	public function Simpan(){
		$na = $this->input->post('no_akun');
		$ha = substr($na, 0,1);
		$data = array(
			'no_akun'     => $this->input->post('no_akun'),
			'nama_akun'   => $this->input->post('nama_akun'),
			'header_akun' => $ha,
			'saldo'       => 0
		);
		$this->db->insert('akun', $data);
	}

	public function Ubah(){
		$this->db->set('nama_akun', $this->input->post('nama_akun_u'));
		$this->db->where('no_akun', $this->input->post('no_akun_u'));
		$this->db->update('akun', $data);
	}

	public function GetDataAkun(){
		$query = $this->db->get('akun');
		return $query->result_array();
	}
}