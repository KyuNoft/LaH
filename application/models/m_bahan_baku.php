<?php
class m_bahan_baku extends ci_model{

	public function Get(){
		$query = $this->db->order_by('kd_bahan_baku', 'ASC')->get('bahan_baku');
		return $query->result();
	}

	public function GeneratePK()
    	{    
    		$this->db->select('RIGHT(bahan_baku.kd_bahan_baku,4) as pk', FALSE);
    		$this->db->order_by('kd_bahan_baku','DESC');    
    		$this->db->limit(1);     
    		$query = $this->db->get('bahan_baku'); //<-----cek dulu apakah ada sudah ada pk di tabel.    
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
    		$pkjadi = "BHN-".$pkmax;     
    	return $pkjadi;  
    	}

	public function Simpan(){
		$data = array(
			'kd_bahan_baku'    => $this->input->post('kd_bahan_baku'),
			'nama_bahan_baku'  => $this->input->post('nama_bahan_baku'),
			'jenis_bahan_baku' => $this->input->post('jenis_bahan_baku'),
			'satuan'           => $this->input->post('satuan'),
			'harga'            => $this->input->post('harga')
		);
		$this->db->insert('bahan_baku', $data);
	}

	public function Ubah(){
		$this->db->set('nama_bahan_baku', $this->input->post('nama_bahan_baku_u'));
		$this->db->set('jenis_bahan_baku', $this->input->post('jenis_bahan_baku_u'));
		$this->db->set('satuan', $this->input->post('satuan_u'));
		$this->db->set('harga', $this->input->post('harga_u'));
		$this->db->where('kd_bahan_baku', $this->input->post('kd_bahan_baku_u'));
		$this->db->update('bahan_baku', $data);
	}

	public function GetDataBahanBaku(){
		$query = $this->db->get('bahan_baku');
		return $query->result_array();
	}
}