<?php
class m_mesin extends ci_model{

	public function Get(){
		$query = $this->db->order_by('kd_mesin', 'ASC')->get('mesin');
		return $query->result();
	}

	public function GeneratePK()
    	{    
    		$this->db->select('RIGHT(mesin.kd_mesin,4) as pk', FALSE);
    		$this->db->order_by('kd_mesin','DESC');    
    		$this->db->limit(1);     
    		$query = $this->db->get('mesin'); //<-----cek dulu apakah ada sudah ada pk di tabel.    
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
    		$pkjadi = "MSN-".$pkmax;     
    	return $pkjadi;  
    	}

	public function Simpan(){
		$data = array(
			'kd_mesin'   => $this->input->post('kd_mesin'),
			'nama_mesin' => $this->input->post('nama_mesin'),
			'satuan' 	 => $this->input->post('satuan'),
			'tarif' 	 => $this->input->post('tarif')
		);
		$this->db->insert('mesin', $data);
	}

	public function Ubah(){
		$this->db->set('nama_mesin', $this->input->post('nama_mesin_u'));
		$this->db->set('tarif', $this->input->post('tarif_u'));
		$this->db->where('kd_mesin', $this->input->post('kd_mesin_u'));
		$this->db->update('mesin', $data);
	}

	public function GetDataMesin(){
		$query = $this->db->get('mesin');
		return $query->result_array();
	}
}