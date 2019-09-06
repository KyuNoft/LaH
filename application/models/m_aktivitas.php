<?php
class m_aktivitas extends ci_model{

	public function Get(){
		$query = $this->db->order_by('kd_aktivitas', 'ASC')->get('aktivitas');
		return $query->result();
	}

	public function GeneratePK()
    	{    
    		$this->db->select('RIGHT(aktivitas.kd_aktivitas,4) as pk', FALSE);
    		$this->db->order_by('kd_aktivitas','DESC');    
    		$this->db->limit(1);     
    		$query = $this->db->get('aktivitas'); //<-----cek dulu apakah ada sudah ada pk di tabel.    
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
    		$pkjadi = "AKT-".$pkmax;     
    	return $pkjadi;  
    	}

	public function Simpan(){
		$data = array(
			'kd_aktivitas'   => $this->input->post('kd_aktivitas'),
			'nama_aktivitas' => $this->input->post('nama_aktivitas'),
			'satuan' 		 => $this->input->post('satuan'),
			'tarif' 		 => $this->input->post('tarif')
		);
		$this->db->insert('aktivitas', $data);
	}

	public function Ubah(){
		$this->db->set('nama_aktivitas', $this->input->post('nama_aktivitas_u'));
		$this->db->set('tarif', $this->input->post('tarif_u'));
		$this->db->where('kd_aktivitas', $this->input->post('kd_aktivitas_u'));
		$this->db->update('aktivitas', $data);
	}

	public function GetDataAktivitas(){
		$query = $this->db->get('aktivitas');
		return $query->result_array();
	}
}