<?php
class m_produk extends ci_model{

	public function Get(){
		$query = $this->db->order_by('kd_produk', 'ASC')->get('produk');
		return $query->result();
	}

	public function GeneratePK()
    	{    
    		$this->db->select('RIGHT(produk.kd_produk,4) as pk', FALSE);
    		$this->db->order_by('kd_produk','DESC');    
    		$this->db->limit(1);     
    		$query = $this->db->get('produk'); //<-----cek dulu apakah ada sudah ada pk di tabel.    
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
    		$pkjadi = "PDK-".$pkmax;     
    	return $pkjadi;  
    	}

	public function Simpan(){
		$data = array(
			'kd_produk'   => $this->input->post('kd_produk'),
			'nama_produk' => $this->input->post('nama_produk'),
			'satuan' 	  => $this->input->post('satuan'),
			'harga'       => $this->input->post('harga')
		);
		$this->db->insert('produk', $data);
	}

	public function GetUbah($kd){
		$this->db->where('kd_produk',$kd);
		return $this->db->get('produk')->row_array();
	}

	public function Ubah(){
		$this->db->set('nama_produk', $this->input->post('nama_produk_u'));
		$this->db->set('harga', $this->input->post('harga_u'));
		$this->db->where('kd_produk', $this->input->post('kd_produk_u'));
		$this->db->update('produk', $data);
	}

	public function GetDataProduk(){
		$query = "SELECT produk.kd_produk, produk.nama_produk
				  FROM produk LEFT JOIN bom
				  ON produk.kd_produk = bom.kd_produk
				  WHERE bom.status = 'Belum' OR bom.status IS NULL
				  GROUP BY kd_produk";
		return $this->db->query($query)->result_array();
	}

	public function GetDataProduk2($kd){
		$this->db->where('kd_produk', $kd);
		return $this->db->get('produk')->row();
	}

	public function GetDataProduk3(){
		$query = "SELECT produk.kd_produk, produk.nama_produk
				  FROM produk LEFT JOIN routing
				  ON produk.kd_produk = routing.kd_produk
				  WHERE routing.status = 'Belum' OR routing.status IS NULL
				  GROUP BY kd_produk";
		return $this->db->query($query)->result_array();
	}

	public function GetDataProduk4(){
		$query = "SELECT produk.kd_produk, produk.nama_produk
				  FROM produk LEFT JOIN jam_mesin
				  ON produk.kd_produk = jam_mesin.kd_produk
				  WHERE jam_mesin.status = 'Belum' OR jam_mesin.status IS NULL
				  GROUP BY kd_produk";
		return $this->db->query($query)->result_array();
	}

	public function GetDataProduk5(){
		$query = "SELECT produk.kd_produk, produk.nama_produk
				  FROM produk JOIN bom
				  ON produk.kd_produk = bom.kd_produk
				  JOIN routing
				  ON produk.kd_produk = routing.kd_produk
				  JOIN jam_mesin
				  ON produk.kd_produk = jam_mesin.kd_produk
				  WHERE bom.status = 'Selesai'
                  AND routing.status = 'Selesai'
                  AND jam_mesin.status = 'Selesai'
                  GROUP BY (kd_produk);";
		return $this->db->query($query)->result_array();
	}	
}