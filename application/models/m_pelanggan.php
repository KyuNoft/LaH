<?php
class m_pelanggan extends ci_model{

	public function Get(){
		$query = $this->db->order_by('id_pelanggan', 'ASC')->get('pelanggan');
		return $query->result();
	}

	public function GeneratePK()
    	{    
    		$this->db->select('RIGHT(pelanggan.id_pelanggan,4) as pk', FALSE);
    		$this->db->order_by('id_pelanggan','DESC');    
    		$this->db->limit(1);     
    		$query = $this->db->get('pelanggan'); //<-----cek dulu apakah ada sudah ada pk di tabel.    
    		if($query->num_rows() <> 0){       
   			//jika pk ternyata sudah ada.      
    		$data = $query->row();      
    		$pk = intval($data->pk) + 1;     
    	}
    	else{       
    	//jika pk belum ada      
    		$pk = 1;     
    		}
    		$pkmax = str_pad($pk, 4, "0", STR_PAD_LEFT);    
    		$pkjadi = "PLG-".$pkmax;     
    	return $pkjadi;  
    	}

	public function Simpan(){
		$data = array(
			'id_pelanggan'   => $this->input->post('id_pelanggan'),
			'nama_pelanggan' => $this->input->post('nama_pelanggan'),
			'no_telp'        => $this->input->post('no_telp'),
			'email'          => $this->input->post('email'),
			'alamat'         => $this->input->post('alamat')
		);
		$this->db->insert('pelanggan', $data);
	}
	
	public function Ubah(){
		$this->db->set('nama_pelanggan', $this->input->post('nama_pelanggan_u'));
		$this->db->set('no_telp', $this->input->post('no_telp_u'));
		$this->db->set('email', $this->input->post('email_u'));
		$this->db->set('alamat', $this->input->post('alamat_u'));
		$this->db->where('id_pelanggan', $this->input->post('id_pelanggan_u'));
		$this->db->update('pelanggan', $data);
	}

	public function GetDataPelanggan(){
		$query = $this->db->get('pelanggan');
		return $query->result_array();
	}
}