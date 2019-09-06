<?php
class m_pesanan extends ci_model{

	public function Get(){
		$this->db->select('a.kd_pesanan, a.tanggal, a.total, a.status, b.nama_pelanggan');
		$this->db->from('pesanan a');
		$this->db->join('pelanggan b', 'a.id_pelanggan = b.id_pelanggan');
		$this->db->where('tanggal !=', '0000-00-00');
		return $this->db->get()->result_array();
	}

	public function GeneratePK(){
	    //Kode pesanan otomatis
		$this->db->select('RIGHT(kd_pesanan,4) as pk', FALSE);
		$this->db->order_by('kd_pesanan','DESC');    
		$this->db->limit(1);
		$query = $this->db->get('pesanan');
		//Cek pk sudah ada atau belum
		if($query->num_rows() != 0){
		    //jika pk ternyata sudah ada
		    $data = $query->row();
		    $pk   = intval($data->pk) + 1;
		}else{       
		    //jika pk belum ada
		    $pk = 1;
		}
		$pkmax = str_pad($pk, 4, "0", STR_PAD_LEFT);
		$pkjadi = "PSN-".$pkmax;

    	//Pembuatan Kode pesanan Baru
		$this->db->where('status', 'BD');
		$query = $this->db->get('pesanan');
		if($query->num_rows() == 0){
			$input = array(
				'kd_pesanan'   => $pkjadi,
				'tanggal' 	   => '0000-00-00',
				'total'        => 0,
				'status'       => 'BD', //Belum  Dibuat//
				'id_pelanggan' => 'PLG-0001', //Pakai yang ada dulu//
			);
			$this->db->insert('pesanan', $input);
		}else{
			$pkjadi = $query->row()->kd_pesanan;
		}
		return $pkjadi;
    }

    public function GetDataDetail($kd){
    	$this->db->select('a.kd_pesanan, a.jumlah, a.subtotal, b.nama_produk, b.harga');
    	$this->db->from('detail_pesanan a');
    	$this->db->join('produk b', 'a.kd_produk = b.kd_produk');
		$this->db->where('a.kd_pesanan', $kd);
		return $this->db->get()->result_array();
	}

	public function CariTanggal(){
		$this->db->select('tanggal');
		$this->db->from('mps');
		$this->db->order_by('tanggal', 'DESC');
		$this->db->limit(1);
		return $this->db->get();
	}

	public function GetDataDetailPesanan(){
    	$this->db->select('a.kd_pesanan, a.jumlah, a.subtotal, b.nama_produk, b.harga');
    	$this->db->from('detail_pesanan a');
    	$this->db->join('produk b', 'a.kd_produk = b.kd_produk');
		$this->db->where('a.kd_pesanan', $this->input->post('kd_pesanan'));
		return $this->db->get()->result_array();
	}

	public function SimpanDetail(){
    	//Ambil Harga dari Tabel produk
    	$this->db->where('kd_produk', $this->input->post('kd_produk'));
    	$harga = $this->db->get('produk')->row()->harga;

        //Masukkan ke detail_pesanan
    	$this->db->where(array('kd_pesanan' => $this->input->post('pk'), 'kd_produk' => $this->input->post('kd_produk')));
    	$query = $this->db->get('detail_pesanan');
    	if($query->num_rows() == 0){
    		$subtotal = $this->input->post('jumlah') * $harga;
    		$insert = array(
			'kd_pesanan' => $this->input->post('pk'),
			'kd_produk'  => $this->input->post('kd_produk'),
			'jumlah'     => $this->input->post('jumlah'),
			'subtotal'   => $subtotal,
		);
			$this->db->insert('detail_pesanan', $insert);
		}else{
			$this->db->set('jumlah', "jumlah + ".$this->input->post('jumlah')."", FALSE);
			$this->db->set('subtotal', "subtotal + ".$this->input->post('jumlah') * $harga."", FALSE);
			$this->db->where(array('kd_pesanan' => $this->input->post('pk'), 'kd_produk' => $this->input->post('kd_produk')));
			$this->db->update('detail_pesanan');
		}
	}

	public function Selesai(){
		//Update Tabel pesanan
		$this->db->set('tanggal', date('y-m-d'));
		$this->db->set('total', $this->input->post('total'));
		$this->db->set('status', 'SD'); //Sudah Dibuat//
		$this->db->set('id_pelanggan', $this->input->post('id_pelanggan'));
		$this->db->where('kd_pesanan', $this->input->post('pk'));
		$this->db->update('pesanan');

		//Generate Jurnal//
		jurnal('112', date('Y-m-d'), 'debit', $this->input->post('total'));
		jurnal('411', date('Y-m-d'), 'kredit', $this->input->post('total'));
	}
}